<?php

namespace Golampi\Traits;

/**
 * Trait para visitar sentencias del AST
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
        if ($context->getChildCount() > 2) {
            for ($i = 1; $i < $context->getChildCount() - 1; $i++) {
                $child = $context->getChild($i);
                if ($child instanceof \Antlr\Antlr4\Runtime\ParserRuleContext) {
                    $this->visit($child);
                }
            }
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
        
        // Por ahora, solo soportamos main
        if ($funcName === 'main') {
            $blockCtx = $context->block();
            if ($blockCtx) {
                $this->visit($blockCtx);
            }
        }
        
        return null;
    }

    /**
     * Visita una llamada a función
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