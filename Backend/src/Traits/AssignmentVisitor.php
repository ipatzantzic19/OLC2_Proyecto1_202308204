<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para manejar asignaciones en el AST.
 */
trait AssignmentVisitor
{
    // =========================================================
    //  ASIGNACIÓN SIMPLE (x = expr, x += expr, …)
    // =========================================================

    public function visitSimpleAssignment($context)
    {
        $varName   = $context->ID()->getText();
        $assignOp  = $context->assignOp()->getText();
        $exprValue = $this->visit($context->expression());

        $line   = $context->getStart()->getLine();
        $column = $context->getStart()->getCharPositionInLine();

        if (!$this->environment->exists($varName)) {
            $this->addSemanticError("Variable '$varName' no declarada", $line, $column);
            return null;
        }

        $currentValue = $this->environment->get($varName);
        if ($currentValue === null) {
            $this->addSemanticError("Variable '$varName' no encontrada", $line, $column);
            return null;
        }

        $newValue = match ($assignOp) {
            '='  => $exprValue,
            '+=' => $this->performAddition($currentValue, $exprValue, $line, $column),
            '-=' => $this->performSubtraction($currentValue, $exprValue, $line, $column),
            '*=' => $this->performMultiplication($currentValue, $exprValue, $line, $column),
            '/=' => $this->performDivision($currentValue, $exprValue, $line, $column),
            default => null,
        };

        if ($newValue === null) {
            $this->addSemanticError(
                "Operador de asignación desconocido: '$assignOp'", $line, $column
            );
            return null;
        }

        // Verificar compatibilidad de tipos solo en asignación simple '='
        if ($assignOp === '=' && !$newValue->isNil()) {
            if ($currentValue->getType() !== $newValue->getType()) {
                $this->addSemanticError(
                    "Incompatibilidad de tipos: no se puede asignar '{$newValue->getType()}'"
                    . " a variable de tipo '{$currentValue->getType()}'",
                    $line, $column
                );
                return null;
            }
        }

        $this->environment->set($varName, $newValue);
        $this->updateSymbolValue($varName, $newValue);

        return null;
    }

    // =========================================================
    //  ASIGNACIÓN A PUNTERO (*ptr = expr, *ptr += expr, …)
    // =========================================================
    public function visitPointerAssignment($context)
    {
        $ptrName   = $context->ID()->getText();
        $assignOp  = $context->assignOp()->getText();
        $newValue  = $this->visit($context->expression());

        $line   = $context->getStart()->getLine();
        $column = $context->getStart()->getCharPositionInLine();

        // Obtener el puntero
        $ptrValue = $this->environment->get($ptrName);

        if ($ptrValue === null || $ptrValue->getType() !== 'pointer') {
            $this->addSemanticError(
                "'$ptrName' no es un puntero válido",
                $line, $column
            );
            return null;
        }

        $data    = $ptrValue->getValue();
        $varName = $data['varName'];
        $env     = $data['env'];

        // Leer valor actual del apuntado
        $current = $env->get($varName);

        $finalValue = match ($assignOp) {
            '='  => $newValue,
            '+=' => $this->performAddition($current, $newValue, $line, $column),
            '-=' => $this->performSubtraction($current, $newValue, $line, $column),
            '*=' => $this->performMultiplication($current, $newValue, $line, $column),
            '/=' => $this->performDivision($current, $newValue, $line, $column),
            default => null,
        };

        if ($finalValue === null) return null;

        // Escribir en el entorno original
        $env->set($varName, $finalValue);
        $this->updateSymbolValue($varName, $finalValue);

        return null;
    }    
    // =========================================================
    //  DECLARACIÓN CORTA (x := expr  o  x, y := f())
    // =========================================================

    public function visitShortVarDecl($context)
    {
        $idList         = $context->idList();
        $expressionList = $context->expressionList();

        $line   = $context->getStart()->getLine();
        $column = $context->getStart()->getCharPositionInLine();

        // Extraer identificadores
        $ids = [];
        for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
            $ids[] = $idList->getChild($i)->getText();
        }

        // Evaluar expresiones
        $expressions = [];
        for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
            $expressions[] = $this->visit($expressionList->getChild($i));
        }

        // ── Desempacar retorno múltiple ───────────────────────────────
        // Caso: a, b := funcion()  donde funcion() retorna Value::multi(...)
        if (count($ids) > 1
            && count($expressions) === 1
            && $expressions[0] instanceof Value
            && $expressions[0]->getType() === 'multi'
        ) {
            $expressions = $expressions[0]->getValue(); // array de Values
        }

        // Verificar coincidencia de cantidades
        if (count($ids) !== count($expressions)) {
            $this->addSemanticError(
                "Número de variables (" . count($ids) . ") no coincide"
                . " con número de valores (" . count($expressions) . ")",
                $line, $column
            );
            return null;
        }

        // Solo válida dentro de funciones
        $scopeName = $this->getCurrentScopeName();
        if ($scopeName === 'global') {
            $this->addSemanticError(
                "La declaración corta (:=) no puede usarse a nivel global",
                $line, $column
            );
            return null;
        }

        // Al menos una variable debe ser nueva en el entorno actual
        $atLeastOneNew = false;
        foreach ($ids as $id) {
            if (!$this->environment->exists($id)) {
                $atLeastOneNew = true;
                break;
            }
        }

        if (!$atLeastOneNew) {
            $this->addSemanticError(
                "Declaración corta requiere que al menos una variable sea nueva",
                $line, $column
            );
            return null;
        }

        // Procesar cada variable
        for ($i = 0; $i < count($ids); $i++) {
            $varName = $ids[$i];
            $value   = $expressions[$i];

            if ($value->isNil()) {
                $this->addSemanticError(
                    "No se puede inferir el tipo de una expresión nil en declaración corta",
                    $line, $column
                );
                continue;
            }

            $inferredType = $value->getType();

            if ($this->environment->exists($varName)) {
                // Variable ya existe en scope padre → reasignar con verificación de tipo
                $currentValue = $this->environment->get($varName);

                if ($currentValue->getType() !== $inferredType) {
                    $this->addSemanticError(
                        "Incompatibilidad de tipos: '$varName' es '{$currentValue->getType()}'"
                        . " pero se asigna '$inferredType'",
                        $line, $column
                    );
                    continue;
                }

                $this->environment->set($varName, $value);
                $this->updateSymbolValue($varName, $value);

            } else {
                // Variable nueva → declarar
                $this->environment->define($varName, $value);

                // addSymbol retorna false si ya existe en la tabla del scope
                // (puede ocurrir en iteraciones de for con ambiente hijo nuevo).
                // En ese caso actualizar el valor sin duplicar.
                $added = $this->addSymbol(
                    $varName, $inferredType, $scopeName,
                    $value, $line, $column
                );

                if (!$added) {
                    $this->updateSymbolValue($varName, $value);
                }
            }
        }

        return null;
    }
}