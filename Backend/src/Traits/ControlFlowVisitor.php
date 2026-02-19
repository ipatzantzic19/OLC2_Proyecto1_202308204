<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Golampi\Exceptions\BreakException;
use Golampi\Exceptions\ContinueException;
use Golampi\Exceptions\ReturnException;

/**
 * Trait para visitar sentencias de control de flujo del AST
 * VERSIÓN CORREGIDA con imports correctos de excepciones
 */
trait ControlFlowVisitor
{
    /**
     * Visita una sentencia if/else-if/else.
     * La gramática define una sola regla para todas las variantes:
     * IF expression block (ELSE IF expression block)* (ELSE block)?
     */
    public function visitIfElseIfElse($context)
    {
        // Obtenemos todas las condiciones (del if y de los else if)
        $conditions = $context->expression();

        // Iteramos a través de todas las condiciones.
        foreach ($conditions as $index => $conditionCtx) {
            $conditionResult = $this->visit($conditionCtx);

            // Validamos que el resultado de la condición sea un valor manejable.
            if (!$conditionResult instanceof Value) {
                $this->addSemanticError(
                    "La condición del 'if' debe ser una expresión válida",
                    $conditionCtx->getStart()->getLine(),
                    $conditionCtx->getStart()->getCharPositionInLine()
                );
                return null; // Detener la ejecución de esta sentencia
            }

            // Si la condición es verdadera...
            if ($conditionResult->toBool()) {
                // ...ejecutamos el bloque correspondiente en un nuevo scope y salimos.
                $blockToVisit = $context->block($index);

                $parentEnv = $this->environment;
                $this->environment = new Environment($parentEnv);
                $this->enterScope('if-block');

                try {
                    $this->visit($blockToVisit);
                } finally {
                    $this->exitScope();
                    $this->environment = $parentEnv;
                }

                return null;
            }
        }

        // Si ninguna condición fue verdadera, verificamos si existe un bloque 'else'.
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

    /**
     * Visita un for tradicional con la nueva gramática
     */
    public function visitForTraditional($context)
    {
        //  CREAR NUEVO AMBIENTE para el scope del for
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        
        //  REGISTRAR SCOPE en tabla de símbolos
        $this->enterScope('for');

        try {
            $forClause = $context->forClause();
            
            // ========== 1. INICIALIZACIÓN ==========
            $initCtx = $forClause->forInit();
            
            if ($initCtx->varDeclaration()) {
                $this->visit($initCtx->varDeclaration());
            } elseif ($initCtx->shortVarDeclaration()) {
                $this->visit($initCtx->shortVarDeclaration());
            } elseif ($initCtx->assignment()) {
                $this->visit($initCtx->assignment());
            } elseif ($initCtx->incDecStatement()) {
                $this->visit($initCtx->incDecStatement());
            }

            // ========== 2. LOOP ==========
            while (true) {
                // Evaluar condición
                if ($forClause->expression()) {
                    $condition = $this->visit($forClause->expression());
                    
                    if (!$condition instanceof Value || !$condition->toBool()) {
                        break;
                    }
                }
                
                // Ejecutar bloque
                try {
                    $this->visit($context->block());
                } catch (BreakException $e) {
                    // Break sale del loop
                    break;
                } catch (ContinueException $e) {
                    // Continue salta al post-incremento
                }
                
                // ========== 3. POST-INCREMENTO ==========
                $postCtx = $forClause->forPost();
                
                if ($postCtx->assignment()) {
                    $this->visit($postCtx->assignment());
                } elseif ($postCtx->incDecStatement()) {
                    $this->visit($postCtx->incDecStatement());
                }
            }
        } catch (ReturnException $e) {
            //  Return propaga hacia arriba
            throw $e;
        } finally {
            //  RESTAURAR AMBIENTE Y SCOPE
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    /**
     * Visita un for estilo while
     */
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

    /**
     * Visita un for infinito
     */
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

    /**
     * Visita una sentencia switch
     */
    public function visitSwitchStatement($context)
    {
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        $this->enterScope('switch');

        try {
            $switchValue = $this->visit($context->expression());

            $matched = false;
            $shouldExecute = false;

            $caseClauses = [];
            $defaultClause = null;

            for ($i = 0; $i < $context->getChildCount(); $i++) {
                $child = $context->getChild($i);
                
                if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                    continue;
                }

                if (method_exists($child, 'expressionList')) {
                    $caseClauses[] = $child;
                } elseif (method_exists($child, 'statement') && !method_exists($child, 'expressionList')) {
                    $defaultClause = $child;
                }
            }

            foreach ($caseClauses as $caseClause) {
                $expressionList = $caseClause->expressionList();
                
                for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
                    $caseValue = $this->visit($expressionList->getChild($i));

                    if (!$matched && $this->valuesEqual($switchValue, $caseValue)) {
                        $matched = true;
                        $shouldExecute = true;
                        break;
                    }
                }

                if ($shouldExecute) {
                    $stmtCount = $caseClause->getChildCount();
                    for ($i = 0; $i < $stmtCount; $i++) {
                        $child = $caseClause->getChild($i);
                        if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                            $this->visit($child);
                        }
                    }
                }
            }

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
        } catch (ReturnException $e) {
            throw $e;
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    /**
     * Visita una sentencia break
     */
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

    /**
     * Visita una sentencia continue
     */
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
     * Visita una sentencia return
     */
    public function visitReturnStatement($context)
    {
        // Asumiendo que las funciones crearán un scope 'function'.
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
            $expr = $this->visit($expressionList->getChild($i));
            $returnValues[] = $expr;
        }

        if (count($returnValues) === 1) {
            throw new ReturnException($returnValues[0]);
        }

        throw new ReturnException(Value::nil());
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

    /**
     * Verifica si el visitor se encuentra dentro de un scope con uno de los tipos proporcionados.
     */
    private function isInsideScope(array $scopeTypes): bool
    {
        // Iterar la pila de scopes desde el más reciente al más antiguo
        for ($i = count($this->scopeStack) - 1; $i >= 0; $i--) {
            if (in_array($this->scopeStack[$i]['name'], $scopeTypes, true)) {
                return true;
            }
        }
        return false;
    }
}