<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Golampi\Exceptions\BreakException;
use Golampi\Exceptions\ContinueException;
use Golampi\Exceptions\ReturnException;

/**
 * Trait para visitar sentencias de control de flujo del AST
 * VERSIÓN COMPLETA para nueva gramática con scopes correctos
 */
trait ControlFlowVisitor
{
    /**
     * Visita una sentencia if-else-if-else (nueva gramática unificada)
     */
    public function visitIfElseIfElse($context)
    {
        // Contar cuántas expresiones (condiciones) hay
        $numExpressions = 0;
        $numBlocks = 0;
        
        for ($i = 0; $i < $context->getChildCount(); $i++) {
            $child = $context->getChild($i);
            
            // Contar expresiones
            if (method_exists($child, 'getRuleIndex')) {
                $ruleName = get_class($child);
                if (strpos($ruleName, 'Expression') !== false) {
                    $numExpressions++;
                }
            }
            
            // Contar bloques
            if (method_exists($context, 'block')) {
                try {
                    $context->block($numBlocks);
                    $numBlocks++;
                } catch (\Exception $e) {
                    break;
                }
            }
        }
        
        // Evaluar primera condición (if)
        $condition = $this->visit($context->expression(0));
        
        if (!$condition instanceof Value) {
            $this->addSemanticError(
                "La condición del 'if' debe ser una expresión válida",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        if ($condition->toBool()) {
            // Ejecutar primer bloque (if)
            return $this->visit($context->block(0));
        }
        
        // Evaluar else if (si existen)
        for ($i = 1; $i < $numExpressions; $i++) {
            $condition = $this->visit($context->expression($i));
            
            if (!$condition instanceof Value) {
                continue;
            }
            
            if ($condition->toBool()) {
                return $this->visit($context->block($i));
            }
        }
        
        // Ejecutar else final (si existe)
        if ($numBlocks > $numExpressions) {
            return $this->visit($context->block($numBlocks - 1));
        }
        
        return null;
    }

    /**
     * Visita un for tradicional con la nueva gramática
     * Soporta: for var i int32 = 0; i < 10; i++ { }
     *          for i := 0; i < 10; i++ { }
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
                // for var i int32 = 0; ...
                $this->visit($initCtx->varDeclaration());
            } elseif ($initCtx->shortVarDeclaration()) {
                // for i := 0; ...
                $this->visit($initCtx->shortVarDeclaration());
            } elseif ($initCtx->assignment()) {
                // for i = 0; ...
                $this->visit($initCtx->assignment());
            } elseif ($initCtx->incDecStatement()) {
                // for i++; ... (raro pero válido)
                $this->visit($initCtx->incDecStatement());
            }
            // Si está vacío, no hacer nada

            // ========== 2. LOOP ==========
            while (true) {
                // Evaluar condición (puede ser null = siempre true)
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
                    // i = i + 1
                    $this->visit($postCtx->assignment());
                } elseif ($postCtx->incDecStatement()) {
                    // i++
                    $this->visit($postCtx->incDecStatement());
                }
            }
        } catch (ReturnException $e) {
            // Return propaga hacia arriba
            throw $e;
        } finally {
            //  RESTAURAR AMBIENTE Y SCOPE
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    /**
     * Visita un for estilo while: for x > 0 { }
     */
    public function visitForWhile($context)
    {
        //  CREAR AMBIENTE
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        
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
        } catch (ReturnException $e) {
            throw $e;
        } finally {
            $this->exitScope();
            $this->environment = $parentEnv;
        }

        return null;
    }

    /**
     * Visita un for infinito: for { }
     */
    public function visitForInfinite($context)
    {
        //  CREAR AMBIENTE
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
        //  CREAR AMBIENTE para switch
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        
        $this->enterScope('switch');

        try {
            // Evaluar la expresión del switch
            $switchValue = $this->visit($context->expression());

            $matched = false;
            $shouldExecute = false;

            // Obtener todos los case clauses y default
            $caseClauses = [];
            $defaultClause = null;

            for ($i = 0; $i < $context->getChildCount(); $i++) {
                $child = $context->getChild($i);
                
                if ($child instanceof \Antlr\Antlr4\Runtime\Tree\TerminalNode) {
                    continue;
                }

                // Detectar caseClause (tiene expressionList)
                if (method_exists($child, 'expressionList')) {
                    $caseClauses[] = $child;
                } 
                // Detectar defaultClause (tiene statement pero no expressionList)
                elseif (method_exists($child, 'statement') && !method_exists($child, 'expressionList')) {
                    $defaultClause = $child;
                }
            }

            // Procesar cada case
            foreach ($caseClauses as $caseClause) {
                // Obtener lista de expresiones del case
                $expressionList = $caseClause->expressionList();
                
                // Evaluar cada expresión en la lista (case 1, 2, 3:)
                for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
                    $caseValue = $this->visit($expressionList->getChild($i));

                    // Comparar valores
                    if (!$matched && $this->valuesEqual($switchValue, $caseValue)) {
                        $matched = true;
                        $shouldExecute = true;
                        break; // Ya encontramos match
                    }
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

        // Para múltiples valores (TODO: implementar soporte completo)
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
}