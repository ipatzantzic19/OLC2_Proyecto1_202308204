<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para visitar expresiones del AST
 */
trait ExpressionVisitor
{
    /**
     * Visita un literal de entero
     */
    public function visitIntLiteral($context)
    {
        return Value::int32((int)$context->INT32()->getText());
    }

    /**
     * Visita un literal de punto flotante
     */
    public function visitFloatLiteral($context)
    {
        return Value::float32((float)$context->FLOAT32()->getText());
    }

    /**
     * Visita un literal de string
     */
    public function visitStringLiteral($context)
    {
        $text = $context->STRING()->getText();
        // Remover comillas
        $value = substr($text, 1, -1);
        // Procesar secuencias de escape
        $value = str_replace('\\n', "\n", $value);
        $value = str_replace('\\t', "\t", $value);
        $value = str_replace('\\r', "\r", $value);
        $value = str_replace('\\\\', '\\', $value);
        return Value::string($value);
    }

    /**
     * Visita un literal booleano verdadero
     */
    public function visitTrueLiteral($context)
    {
        return Value::bool(true);
    }

    /**
     * Visita un literal booleano falso
     */
    public function visitFalseLiteral($context)
    {
        return Value::bool(false);
    }

    /**
     * Visita un literal nil
     */
    public function visitNilLiteral($context)
    {
        return Value::nil();
    }

    /**
     * Visita una expresión con paréntesis
     */
    public function visitGroupedExpression($context)
    {
        return $this->visit($context->expression());
    }

    /**
     * Visita una expresión aditiva (suma o resta)
     */
    public function visitAdditive($context)
    {
        $left = $this->visit($context->multiplicative(0));
        
        $multiplicativeIndex = 1;
        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            $op = $context->getChild($i)->getText();
            $right = $this->visit($context->multiplicative($multiplicativeIndex));
            $multiplicativeIndex++;
            
            if ($op === '+') {
                $left = $this->performAddition($left, $right);
            } elseif ($op === '-') {
                $left = $this->performSubtraction($left, $right);
            }
        }
        
        return $left;
    }

    /**
     * Visita una expresión multiplicativa
     */
    public function visitMultiplicative($context)
    {
        $left = $this->visit($context->unary(0));
        
        $unaryIndex = 1;
        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            $op = $context->getChild($i)->getText();
            $right = $this->visit($context->unary($unaryIndex));
            $unaryIndex++;
            
            switch ($op) {
                case '*':
                    $left = $this->performMultiplication($left, $right);
                    break;
                case '/':
                    $left = $this->performDivision($left, $right);
                    break;
                case '%':
                    $left = $this->performModulo($left, $right);
                    break;
            }
        }
        
        return $left;
    }

    /**
     * Visita una expresión unaria primaria
     */
    public function visitPrimaryUnary($context)
    {
        return $this->visit($context->primary());
    }

    /**
     * Visita una negación unaria
     */
    public function visitNegativeUnary($context)
    {
        $val = $this->visit($context->unary());
        
        if ($val->getType() === 'int32') {
            return Value::int32(-$val->getValue());
        } elseif ($val->getType() === 'float32') {
            return Value::float32(-$val->getValue());
        }
        
        return Value::nil();
    }

    /**
     * Visita una negación lógica
     */
    public function visitNotUnary($context)
    {
        $val = $this->visit($context->unary());
        return Value::bool(!$val->toBool());
    }

    /**
     * Visita una expresión de igualdad
     */
    public function visitEquality($context)
    {
        if ($context->getChildCount() === 1) {
            return $this->visit($context->relational(0));
        }

        $left = $this->visit($context->relational(0));

        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            $op = $context->getChild($i)->getText();
            $right = $this->visit($context->relational($i / 2));
            $left = $this->performComparison($op, $left, $right);
        }

        return $left;
    }

    /**
     * Visita una expresión relacional
     */
    public function visitRelational($context)
    {
        if ($context->getChildCount() === 1) {
            return $this->visit($context->additive(0));
        }

        $left = $this->visit($context->additive(0));

        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            $op = $context->getChild($i)->getText();
            $right = $this->visit($context->additive($i / 2));
            $left = $this->performComparison($op, $left, $right);
        }

        return $left;
    }

    /**
     * Visita una expresión lógica AND
     */
    public function visitLogicalAnd($context)
    {
        if ($context->getChildCount() === 1) {
            return $this->visit($context->equality(0));
        }

        $left = $this->visit($context->equality(0));

        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            if (!$left->toBool()) {
                return Value::bool(false);
            }
            $right = $this->visit($context->equality($i / 2));
            $left = Value::bool($right->toBool());
        }

        return Value::bool($left->toBool());
    }

    /**
     * Visita una expresión lógica OR
     */
    public function visitLogicalOr($context)
    {
        if ($context->getChildCount() === 1) {
            return $this->visit($context->logicalAnd(0));
        }

        $left = $this->visit($context->logicalAnd(0));

        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            if ($left->toBool()) {
                return Value::bool(true);
            }
            $right = $this->visit($context->logicalAnd($i / 2));
            $left = Value::bool($right->toBool());
        }

        return Value::bool($left->toBool());
    }
}