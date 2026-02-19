<?php

namespace Golampi\Traits;

use Golampi\Runtime\Environment;

/**
 * Trait para visitar sentencias del AST
 * VERSIÓN CORREGIDA: No registra llamadas a funciones en tabla de símbolos
 */
trait StatementVisitor
{
    /**
     * Visita el programa principal
     */
    public function visitProgram($context)
    {
        if ($context->getChildCount() > 0) {
            for ($i = 0; $i < $context->getChildCount() - 1; $i++) {
                $child = $context->getChild($i);
                if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                    $this->visit($child);
                }
            }
        }
        return null;
    }

    /**
     * Visita una declaración
     */
    public function visitDeclaration($context)
    {
        return $this->visitChildren($context);
    }

    /**
     * Visita un bloque de código
     */
    public function visitBlock($context)
    {
        // Crear nuevo ambiente para el bloque
        $parentEnv = $this->environment;
        $this->environment = new Environment($parentEnv);
        
        // Crear scope en tabla de símbolos solo si no estamos ya en un scope especial
        $currentScope = $this->getCurrentScopeName();
        $createScope = !in_array($currentScope, ['for', 'switch', 'function:main', 'if-block', 'else-block']);
        
        if ($createScope) {
            $this->enterScope('block');
        }

        try {
            // Visitar contenido del bloque
            if ($context->getChildCount() > 2) {
                for ($i = 1; $i < $context->getChildCount() - 1; $i++) {
                    $child = $context->getChild($i);
                    if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                        $this->visit($child);
                    }
                }
            }
        } finally {
            // Restaurar ambiente
            if ($createScope) {
                $this->exitScope();
            }
            $this->environment = $parentEnv;
        }

        return null;
    }

    /**
     * Visita una sentencia de expresión
     */
    public function visitExpressionStatement($context)
    {
        return $this->visit($context->expression());
    }

    /**
     * Visita una declaración de función
     */
    public function visitFuncDeclSingleReturn($context)
    {
        $funcName = $context->ID()->getText();
        
        //  REGISTRAR FUNCIÓN en tabla de símbolos (solo la DECLARACIÓN)
        $this->addSymbol(
            $funcName,
            'function',
            'global',
            \Golampi\Runtime\Value::nil(),
            $context->getStart()->getLine(),
            $context->getStart()->getCharPositionInLine()
        );
        
        // Por ahora, solo ejecutamos main
        if ($funcName === 'main') {
            // Crear scope para la función
            $parentEnv = $this->environment;
            $this->environment = new Environment($parentEnv);
            $this->enterScope('function:main');
            
            try {
                $blockCtx = $context->block();
                if ($blockCtx) {
                    // Visitar el contenido del bloque
                    if ($blockCtx->getChildCount() > 2) {
                        for ($i = 1; $i < $blockCtx->getChildCount() - 1; $i++) {
                            $child = $blockCtx->getChild($i);
                            if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                                $this->visit($child);
                            }
                        }
                    }
                }
            } finally {
                $this->exitScope();
                $this->environment = $parentEnv;
            }
        }
        
        return null;
    }

    /**
     * Visita una llamada a función
     *  CORRECCIÓN: NO registra la llamada en la tabla de símbolos
     */
    public function visitFunctionCall($context)
    {
        $ids = $context->ID();

        // Obtener nombre de función
        if (is_array($ids)) {
            // fmt.Println
            $funcName = $ids[0]->getText() . '.' . $ids[1]->getText();
        } else {
            // len(x)
            $funcName = $ids->getText();
        }

        $args = [];
        $argList = $context->argumentList();

        if ($argList) {
            for ($i = 0; $i < $argList->getChildCount(); $i += 2) {
                $expr = $argList->getChild($i);
                $args[] = $this->visit($expr);
            }
        }

        // Buscar función
        if ($this->functionExists($funcName)) {
            //  CAMBIO: Ya NO registramos la llamada en la tabla de símbolos
            // Solo ejecutamos la función
            $func = $this->getFunction($funcName);
            return $func(...$args);
        }

        // Error semántico
        $this->addSemanticError(
            "Función no definida: $funcName",
            $context->getStart()->getLine(),
            $context->getStart()->getCharPositionInLine()
        );

        return \Golampi\Runtime\Value::nil();
    }
}