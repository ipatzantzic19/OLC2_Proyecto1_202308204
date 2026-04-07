<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Golampi\Exceptions\BreakException;
use Golampi\Exceptions\ContinueException;
use Golampi\Exceptions\ReturnException;

/**
 * Trait para visitar sentencias de control de flujo del AST.
 */
trait ControlFlowVisitor
{
    // =========================================================
    //  IF / ELSE-IF / ELSE
    // =========================================================

    public function visitIfElseIfElse($context)
    {
        $conditions = $context->expression();

        foreach ($conditions as $index => $conditionCtx) {
            $conditionResult = $this->visit($conditionCtx);

            if (!$conditionResult instanceof Value) {
                $this->addSemanticError(
                    "La condición del 'if' debe ser una expresión válida",
                    $conditionCtx->getStart()->getLine(),
                    $conditionCtx->getStart()->getCharPositionInLine()
                );
                return null;
            }

            if ($conditionResult->toBool()) {
                $parentEnv = $this->environment;
                $this->environment = new Environment($parentEnv);
                $this->enterScope('if-block');

                try {
                    $this->visit($context->block($index));
                } finally {
                    $this->exitScope();
                    $this->environment = $parentEnv;
                }

                return null;
            }
        }

        // Bloque else (si existe)
        if (count($context->block()) > count($conditions)) {
            $elseBlock = $context->block(count($context->block()) - 1);

            $parentEnv = $this->environment;
            $this->environment = new Environment($parentEnv);
            $this->enterScope('else-block');

            try {
                $this->visit($elseBlock);
            } finally {
                $this->exitScope();
                $this->environment = $parentEnv;
            }
        }

        return null;
    }

    // =========================================================
    //  FOR TRADICIONAL
    // =========================================================

    public function visitForTraditional($context)
    {
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        $this->enterScope('for');

        try {
            $forClause = $context->forClause();

            // 1. Inicialización
            $initCtx = $forClause->forInit();
            if ($initCtx->varDeclaration())     { $this->visit($initCtx->varDeclaration()); }
            elseif ($initCtx->shortVarDeclaration()) { $this->visit($initCtx->shortVarDeclaration()); }
            elseif ($initCtx->assignment())     { $this->visit($initCtx->assignment()); }
            elseif ($initCtx->incDecStatement()){ $this->visit($initCtx->incDecStatement()); }

            // 2. Loop
            while (true) {
                if ($forClause->expression()) {
                    $condition = $this->visit($forClause->expression());
                    if (!$condition instanceof Value || !$condition->toBool()) {
                        break;
                    }
                }

                try {
                    $this->visit($context->block());
                } catch (BreakException $e) {
                    break;
                } catch (ContinueException $e) {
                    // continúa al post-incremento
                }

                // 3. Post-incremento
                $postCtx = $forClause->forPost();
                if ($postCtx->assignment())     { $this->visit($postCtx->assignment()); }
                elseif ($postCtx->incDecStatement()) { $this->visit($postCtx->incDecStatement()); }
            }

        } catch (ReturnException $e) {
            throw $e;
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    // =========================================================
    //  FOR WHILE
    // =========================================================

    public function visitForWhile($context)
    {
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        $this->enterScope('for');

        try {
            while (true) {
                $condition = $this->visit($context->expression());
                if (!$condition instanceof Value || !$condition->toBool()) {
                    break;
                }

                try {
                    $this->visit($context->block());
                } catch (BreakException $e) {
                    break;
                } catch (ContinueException $e) {
                    continue;
                }
            }
        } catch (ReturnException $e) {
            throw $e;
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    // =========================================================
    //  FOR INFINITO
    // =========================================================

    public function visitForInfinite($context)
    {
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
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
        } catch (ReturnException $e) {
            throw $e;
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    // =========================================================
    //  SWITCH
    // =========================================================

    public function visitSwitchStatement($context)
    {
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        $this->enterScope('switch');

        try {
            $switchValue = $this->visit($context->expression());

            $matched = false;

            // Recorrer cada caseClause
            foreach ($context->caseClause() as $caseClause) {
                if ($matched) break;

                // Evaluar la lista de expresiones/rangos del case
                $caseMatched = $this->evaluateCaseExpressionList(
                    $caseClause->caseExpressionList(),
                    $switchValue
                );

                if ($caseMatched) {
                    $matched = true;

                    // Ejecutar los statements del case
                    try {
                        foreach ($caseClause->statement() as $stmt) {
                            $this->visit($stmt);
                        }
                    } catch (BreakException $e) {
                        // break explícito dentro del case: salir del switch
                    }
                }
            }

            // defaultClause si ningún case coincidió
            if (!$matched && $context->defaultClause() !== null) {
                $defaultClause = $context->defaultClause();
                try {
                    foreach ($defaultClause->statement() as $stmt) {
                        $this->visit($stmt);
                    }
                } catch (BreakException $e) {
                    // break explícito en default
                }
            }

        } catch (ReturnException $e) {
            throw $e;
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    // =========================================================
    //  EVALUACIÓN DE LISTA DE EXPRESIONES/RANGOS DE UN CASE
    // =========================================================

    /**
     * Evalúa si el switchValue coincide con alguna de las expresiones
     * o rangos de un caseExpressionList.
     *
     * Soporta:
     *   case 1, 2, 3:          → SingleCaseExpr separadas por coma
     *   case 80..89:           → RangeCaseExpr  (ambos extremos incluidos)
     *   case 1, 10..20, 30:    → mezcla de ambos
     */
    private function evaluateCaseExpressionList($caseExpressionList, Value $switchValue): bool
    {
        if ($caseExpressionList === null) {
            return false;
        }

        foreach ($caseExpressionList->caseExpression() as $caseExpr) {
            if ($this->evaluateCaseExpression($caseExpr, $switchValue)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Evalúa un único caseExpression (single o range) contra switchValue.
     */
    private function evaluateCaseExpression($caseExpr, Value $switchValue): bool
    {
        // Detectar si es RangeCaseExpr o SingleCaseExpr por el número de
        // expresiones hijas y la presencia del token '..'
        $expressions = $caseExpr->expression();

        // RangeCaseExpr: tiene exactamente 2 expresiones hijas (low .. high)
        if (is_array($expressions) && count($expressions) === 2) {
            return $this->evaluateRangeCase(
                $expressions[0],
                $expressions[1],
                $switchValue
            );
        }

        // SingleCaseExpr: una sola expresión
        $exprCtx = is_array($expressions) ? $expressions[0] : $expressions;
        $caseValue = $this->visit($exprCtx);
        return $this->valuesEqual($switchValue, $caseValue);
    }

    /**
     * Evalúa si switchValue está en el rango [lowExpr .. highExpr] (ambos inclusive).
     * Solo aplica a tipos numéricos (int32, float32, rune).
     */
    private function evaluateRangeCase($lowExprCtx, $highExprCtx, Value $switchValue): bool
    {
        $numericTypes = ['int32', 'float32', 'rune'];

        if (!in_array($switchValue->getType(), $numericTypes, true)) {
            $this->addSemanticError(
                "El rango '..' en 'case' solo es válido para tipos numéricos (int32, float32, rune), "
                . "se encontró '{$switchValue->getType()}'",
                $lowExprCtx->getStart()->getLine(),
                $lowExprCtx->getStart()->getCharPositionInLine()
            );
            return false;
        }

        $lowValue  = $this->visit($lowExprCtx);
        $highValue = $this->visit($highExprCtx);

        if (!in_array($lowValue->getType(), $numericTypes, true)
            || !in_array($highValue->getType(), $numericTypes, true)
        ) {
            $this->addSemanticError(
                "Los límites del rango '..' en 'case' deben ser valores numéricos",
                $lowExprCtx->getStart()->getLine(),
                $lowExprCtx->getStart()->getCharPositionInLine()
            );
            return false;
        }

        $sv  = $switchValue->getValue();
        $low = $lowValue->getValue();
        $hi  = $highValue->getValue();

        return $sv >= $low && $sv <= $hi;
    }

    // =========================================================
    //  BREAK / CONTINUE / RETURN
    // =========================================================

    public function visitBreakStatement($context)
    {
        if (!$this->isInsideScope(['for', 'switch'])) {
            $this->addSemanticError(
                "La sentencia 'break' solo puede usarse dentro de un ciclo ('for') o un 'switch'",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }
        throw new BreakException();
    }

    public function visitContinueStatement($context)
    {
        if (!$this->isInsideScope(['for'])) {
            $this->addSemanticError(
                "La sentencia 'continue' solo puede usarse dentro de un ciclo ('for')",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }
        throw new ContinueException();
    }

    /**
     * Visita un return. Soporta retorno vacío, simple y múltiple.
     */
    public function visitReturnStatement($context)
    {
        if (!$this->isInsideScope(['function'])) {
            $this->addSemanticError(
                "La sentencia 'return' solo puede usarse dentro de una función",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }

        $expressionList = $context->expressionList();

        if ($expressionList === null) {
            throw new ReturnException(Value::nil());
        }

        $returnValues = [];
        for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
            $returnValues[] = $this->visit($expressionList->getChild($i));
        }

        if (count($returnValues) === 0) {
            throw new ReturnException(Value::nil());
        }

        if (count($returnValues) === 1) {
            throw new ReturnException($returnValues[0]);
        }

        // Múltiples valores de retorno → Value::multi
        throw new ReturnException(Value::multi($returnValues));
    }

    // =========================================================
    //  HELPERS PRIVADOS
    // =========================================================

    /**
     * Compara dos valores para igualdad (usado en switch single case).
     */
    private function valuesEqual(Value $a, Value $b): bool
    {
        if ($a->getType() !== $b->getType()) return false;
        return $a->getValue() == $b->getValue();
    }

    /**
     * Verifica si el visitante está dentro de un scope del tipo indicado.
     * Soporta coincidencia exacta Y de prefijo (p.ej. 'function' coincide
     * con 'function:main', 'function:suma', etc.).
     */
    private function isInsideScope(array $scopeTypes): bool
    {
        for ($i = count($this->scopeStack) - 1; $i >= 0; $i--) {
            $scopeName = $this->scopeStack[$i]['name'];
            foreach ($scopeTypes as $type) {
                if ($scopeName === $type
                    || str_starts_with($scopeName, $type . ':')
                ) {
                    return true;
                }
            }
        }
        return false;
    }
}