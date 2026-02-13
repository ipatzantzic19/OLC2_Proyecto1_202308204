<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;
use Golampi\Exceptions\BreakException;
use Golampi\Exceptions\ContinueException;
use Golampi\Exceptions\ReturnException;

/**
 * Trait para visitar sentencias de control de flujo del AST
 */
trait ControlFlowVisitor
{
    /**
     * Visita una sentencia if-else
     */
    public function visitIfElse($context)
    {
        // Evaluar la condición
        $condition = $this->visit($context->expression());

        // Validar que la condición sea booleana
        if (!$condition instanceof Value) {
            $this->addSemanticError(
                "La condición del 'if' debe ser una expresión válida",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }

        // Ejecutar el bloque correspondiente
        if ($condition->toBool()) {
            // Ejecutar bloque if
            $this->visit($context->block(0));
        } else {
            // Ejecutar bloque else si existe
            if ($context->getChildCount() > 3) { // if expr block else block
                $this->visit($context->block(1));
            }
        }

        return null;
    }

    /**
     * Visita una sentencia if-else-if
     */
    public function visitIfElseIf($context)
    {
        // Evaluar la condición
        $condition = $this->visit($context->expression());

        // Validar que la condición sea booleana
        if (!$condition instanceof Value) {
            $this->addSemanticError(
                "La condición del 'if' debe ser una expresión válida",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }

        // Ejecutar el bloque correspondiente
        if ($condition->toBool()) {
            // Ejecutar bloque if
            $this->visit($context->block());
        } else {
            // Ejecutar else if si existe
            if ($context->ifStatement()) {
                $this->visit($context->ifStatement());
            }
        }

        return null;
    }

    /**
     * Visita un for tradicional: for i := 0; i < 10; i++ { }
     */
    public function visitForTraditional($context)
    {
        // Crear nuevo scope para el for
        $this->enterScope('for');

        try {
            // 1. Inicialización
            $this->visit($context->varDeclaration());

            // 2. Loop
            while (true) {
                // Evaluar condición
                $condition = $this->visit($context->expression(0));

                if (!$condition instanceof Value || !$condition->toBool()) {
                    break;
                }

                // Ejecutar bloque
                try {
                    $this->visit($context->block());
                } catch (BreakException $e) {
                    break;
                } catch (ContinueException $e) {
                    // Continuar al siguiente ciclo
                }

                // 3. Post-iteración (incremento)
                $this->visit($context->expression(1));
            }
        } finally {
            $this->exitScope();
        }

        return null;
    }

    /**
     * Visita un for estilo while: for x > 0 { }
     */
    public function visitForWhile($context)
    {
        $this->enterScope('for');

        try {
            while (true) {
                // Evaluar condición
                $condition = $this->visit($context->expression());

                if (!$condition instanceof Value || !$condition->toBool()) {
                    break;
                }

                // Ejecutar bloque
                try {
                    $this->visit($context->block());
                } catch (BreakException $e) {
                    break;
                } catch (ContinueException $e) {
                    continue;
                }
            }
        } finally {
            $this->exitScope();
        }

        return null;
    }

    /**
     * Visita un for infinito: for { }
     */
    public function visitForInfinite($context)
    {
        $this->enterScope('for');

        try {
            while (true) {
                try {
                    $this->visit($context->block());
                } catch (BreakException $e) {
                    break;
                } catch (ContinueException $e) {
                    continue;
                }
            }
        } finally {
            $this->exitScope();
        }

        return null;
    }

    /**
     * Visita una sentencia switch
     */
    public function visitSwitchStatement($context)
    {
        // Evaluar la expresión del switch
        $switchValue = $this->visit($context->expression());

        $matched = false;
        $shouldExecute = false;

        // Obtener todos los case clauses
        $caseClauses = [];
        $defaultClause = null;

        for ($i = 0; $i < $context->getChildCount(); $i++) {
            $child = $context->getChild($i);
            
            if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                continue;
            }

            $ruleName = $child->getRuleContext()->getRuleIndex();
            
            // Verificar si es un caseClause
            if (method_exists($child, 'expression')) {
                $caseClauses[] = $child;
            } elseif (method_exists($child, 'statement')) {
                // Es el defaultClause
                $defaultClause = $child;
            }
        }

        try {
            // Procesar cada case
            foreach ($caseClauses as $caseClause) {
                $caseValue = $this->visit($caseClause->expression());

                // Comparar valores
                if (!$matched && $this->valuesEqual($switchValue, $caseValue)) {
                    $matched = true;
                    $shouldExecute = true;
                }

                // Si ya hubo match, ejecutar (fall-through automático)
                if ($shouldExecute) {
                    // Ejecutar todas las sentencias del case
                    $stmtCount = $caseClause->getChildCount();
                    for ($i = 0; $i < $stmtCount; $i++) {
                        $child = $caseClause->getChild($i);
                        if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                            $this->visit($child);
                        }
                    }
                }
            }

            // Si no hubo match y hay default, ejecutarlo
            if (!$matched && $defaultClause !== null) {
                $stmtCount = $defaultClause->getChildCount();
                for ($i = 0; $i < $stmtCount; $i++) {
                    $child = $defaultClause->getChild($i);
                    if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                        $this->visit($child);
                    }
                }
            }
        } catch (BreakException $e) {
            // Break sale del switch
            return null;
        }

        return null;
    }

    /**
     * Visita una sentencia break
     */
    public function visitBreakStatement($context)
    {
        throw new BreakException();
    }

    /**
     * Visita una sentencia continue
     */
    public function visitContinueStatement($context)
    {
        throw new ContinueException();
    }

    /**
     * Visita una sentencia return
     */
    public function visitReturnStatement($context)
    {
        $expressionList = $context->expressionList();

        if ($expressionList === null) {
            // return sin valor
            throw new ReturnException(Value::nil());
        }

        // Evaluar las expresiones de retorno
        $returnValues = [];
        for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
            $expr = $this->visit($expressionList->getChild($i));
            $returnValues[] = $expr;
        }

        // Si es un solo valor, retornar directamente
        if (count($returnValues) === 1) {
            throw new ReturnException($returnValues[0]);
        }

        // Para múltiples valores, crear un array
        throw new ReturnException(Value::nil()); // TODO: Implementar múltiples retornos
    }

    /**
     * Compara dos valores para igualdad (usado en switch)
     */
    private function valuesEqual(Value $a, Value $b): bool
    {
        if ($a->getType() !== $b->getType()) {
            return false;
        }

        return $a->getValue() == $b->getValue();
    }
}