<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para manejar asignaciones en el AST
 */
trait AssignmentVisitor
{
    /**
     * Visita una asignación simple (x = expresión o x += 5, etc.)
     */
    public function visitSimpleAssignment($context)
    {
        $varName = $context->ID()->getText();
        $assignOp = $context->assignOp()->getText();
        $exprValue = $this->visit($context->expression());
        
        $line = $context->getStart()->getLine();
        $column = $context->getStart()->getCharPositionInLine();
        
        // Verificar si la variable existe
        if (!$this->environment->exists($varName)) {
            $this->addSemanticError(
                "Variable '$varName' no declarada",
                $line,
                $column
            );
            return null;
        }
        
        // Obtener el valor actual de la variable
        $currentValue = $this->environment->get($varName);
        
        if ($currentValue === null) {
            $this->addSemanticError(
                "Variable '$varName' no encontrada en el entorno actual",
                $line,
                $column
            );
            return null;
        }
        
        // Calcular el nuevo valor según el operador
        $newValue = null;
        
        switch ($assignOp) {
            case '=':
                $newValue = $exprValue;
                break;
                
            case '+=':
                $newValue = $this->performAddition($currentValue, $exprValue, $line, $column);
                break;
                
            case '-=':
                $newValue = $this->performSubtraction($currentValue, $exprValue, $line, $column);
                break;
                
            case '*=':
                $newValue = $this->performMultiplication($currentValue, $exprValue, $line, $column);
                break;
                
            case '/=':
                $newValue = $this->performDivision($currentValue, $exprValue, $line, $column);
                break;
                
            default:
                $this->addSemanticError(
                    "Operador de asignación desconocido: '$assignOp'",
                    $line,
                    $column
                );
                return null;
        }
        
        // Verificar compatibilidad de tipos solo para asignación simple
        if ($assignOp === '=' && !$newValue->isNil()) {
            if ($currentValue->getType() !== $newValue->getType()) {
                $this->addSemanticError(
                    "Incompatibilidad de tipos: no se puede asignar '{$newValue->getType()}' a variable de tipo '{$currentValue->getType()}'",
                    $line,
                    $column
                );
                return null;
            }
        }
        
        //  ACTUALIZAR en el entorno
        $this->environment->set($varName, $newValue);
        
        //  ACTUALIZAR en la tabla de símbolos
        $this->updateSymbolValue($varName, $newValue);
        
        return null;
    }
    
    /**
     * Visita una declaración corta (y := 100)
     */
    public function visitShortVarDecl($context)
    {
        $idList = $context->idList();
        $expressionList = $context->expressionList();
        
        $line = $context->getStart()->getLine();
        $column = $context->getStart()->getCharPositionInLine();
        
        // Extraer los identificadores
        $ids = [];
        if ($idList->getChildCount() > 0) {
            for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
                $id = $idList->getChild($i)->getText();
                $ids[] = $id;
            }
        }
        
        // Evaluar las expresiones
        $expressions = [];
        if ($expressionList->getChildCount() > 0) {
            for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
                $expr = $this->visit($expressionList->getChild($i));
                $expressions[] = $expr;
            }
        }
        
        // Verificar que coincidan las cantidades
        if (count($ids) !== count($expressions)) {
            $this->addSemanticError(
                "Número de variables (" . count($ids) . ") no coincide con número de valores (" . count($expressions) . ")",
                $line,
                $column
            );
            return null;
        }
        
        // Verificar que al menos una variable sea nueva
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
                $line,
                $column
            );
            return null;
        }
        
        // Verificar que estamos dentro de una función (no global)
        $scopeName = $this->getCurrentScopeName();
        if ($scopeName === 'global') {
            $this->addSemanticError(
                "La declaración corta (:=) no puede usarse a nivel global",
                $line,
                $column
            );
            return null;
        }
        
        // Procesar cada variable
        for ($i = 0; $i < count($ids); $i++) {
            $varName = $ids[$i];
            $value = $expressions[$i];
            
            if ($value->isNil()) {
                $this->addSemanticError(
                    "No se puede inferir el tipo de una expresión nil en declaración corta",
                    $line,
                    $column
                );
                continue;
            }
            
            // Inferir el tipo del valor
            $inferredType = $value->getType();
            
            if ($this->environment->exists($varName)) {
                // Variable ya existe - reasignar
                $currentValue = $this->environment->get($varName);
                
                // Verificar compatibilidad de tipos
                if ($currentValue->getType() !== $inferredType) {
                    $this->addSemanticError(
                        "Incompatibilidad de tipos: variable '$varName' es de tipo '{$currentValue->getType()}' pero se intenta asignar '{$inferredType}'",
                        $line,
                        $column
                    );
                    continue;
                }
                
                //  ACTUALIZAR en el entorno
                $this->environment->set($varName, $value);
                
                //  ACTUALIZAR en la tabla de símbolos
                $this->updateSymbolValue($varName, $value);
            } else {
                // Variable nueva - declarar
                $this->environment->define($varName, $value);
                
                //  AÑADIR a la tabla de símbolos
                $this->addSymbol(
                    $varName,
                    $inferredType,
                    $scopeName,
                    $value,
                    $line,
                    $column
                );
            }
        }
        
        return null;
    }
}