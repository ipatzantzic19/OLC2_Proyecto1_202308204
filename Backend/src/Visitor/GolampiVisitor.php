<?php

namespace Golampi\Visitor;
require_once __DIR__ . '/../../generated/GolampiVisitor.php';
use Golampi\Runtime\Value;

/**
 * Este será el visitor principal que extenderá el visitor generado por ANTLR
 * Aquí implementaremos los métodos visit* para cada regla de la gramática
 */
class GolampiVisitor extends \GolampiVisitor
{
    /**
     * Ejemplo de cómo implementar operaciones aritméticas
     * Estas seguirán las tablas de compatibilidad del proyecto
     */
    protected function performAddition(Value $left, Value $right): Value
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        // nil + cualquier cosa = nil
        if ($left->isNil() || $right->isNil()) {
            return Value::nil();
        }

        // int32 + int32 = int32
        if ($leftType === 'int32' && $rightType === 'int32') {
            return Value::int32($left->getValue() + $right->getValue());
        }

        // int32 + float32 = float32
        if ($leftType === 'int32' && $rightType === 'float32') {
            return Value::float32((float)$left->getValue() + $right->getValue());
        }

        // float32 + int32 = float32
        if ($leftType === 'float32' && $rightType === 'int32') {
            return Value::float32($left->getValue() + (float)$right->getValue());
        }

        // float32 + float32 = float32
        if ($leftType === 'float32' && $rightType === 'float32') {
            return Value::float32($left->getValue() + $right->getValue());
        }

        // int32 + rune = int32
        if ($leftType === 'int32' && $rightType === 'rune') {
            return Value::int32($left->getValue() + $right->getValue());
        }

        // rune + int32 = int32
        if ($leftType === 'rune' && $rightType === 'int32') {
            return Value::int32($left->getValue() + $right->getValue());
        }

        // string + string = string (concatenación)
        if ($leftType === 'string' && $rightType === 'string') {
            return Value::string($left->getValue() . $right->getValue());
        }

        // Operación inválida
        return Value::nil();
    }

    protected function performSubtraction(Value $left, Value $right): Value
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        if ($left->isNil() || $right->isNil()) {
            return Value::nil();
        }

        // int32 - int32 = int32
        if ($leftType === 'int32' && $rightType === 'int32') {
            return Value::int32($left->getValue() - $right->getValue());
        }

        // int32 - float32 = float32
        if ($leftType === 'int32' && $rightType === 'float32') {
            return Value::float32((float)$left->getValue() - $right->getValue());
        }

        // float32 - int32 = float32
        if ($leftType === 'float32' && $rightType === 'int32') {
            return Value::float32($left->getValue() - (float)$right->getValue());
        }

        // float32 - float32 = float32
        if ($leftType === 'float32' && $rightType === 'float32') {
            return Value::float32($left->getValue() - $right->getValue());
        }

        // int32 - rune = int32
        if ($leftType === 'int32' && $rightType === 'rune') {
            return Value::int32($left->getValue() - $right->getValue());
        }

        // rune - int32 = int32
        if ($leftType === 'rune' && $rightType === 'int32') {
            return Value::int32($left->getValue() - $right->getValue());
        }

        return Value::nil();
    }

    protected function performMultiplication(Value $left, Value $right): Value
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        if ($left->isNil() || $right->isNil()) {
            return Value::nil();
        }

        // int32 * int32 = int32
        if ($leftType === 'int32' && $rightType === 'int32') {
            return Value::int32($left->getValue() * $right->getValue());
        }

        // int32 * float32 = float32
        if ($leftType === 'int32' && $rightType === 'float32') {
            return Value::float32((float)$left->getValue() * $right->getValue());
        }

        // float32 * int32 = float32
        if ($leftType === 'float32' && $rightType === 'int32') {
            return Value::float32($left->getValue() * (float)$right->getValue());
        }

        // float32 * float32 = float32
        if ($leftType === 'float32' && $rightType === 'float32') {
            return Value::float32($left->getValue() * $right->getValue());
        }

        // int32 * string = string (repetición)
        if ($leftType === 'int32' && $rightType === 'string') {
            return Value::string(str_repeat($right->getValue(), $left->getValue()));
        }

        // string * int32 = string (repetición)
        if ($leftType === 'string' && $rightType === 'int32') {
            return Value::string(str_repeat($left->getValue(), $right->getValue()));
        }

        return Value::nil();
    }

    protected function performDivision(Value $left, Value $right): Value
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        if ($left->isNil() || $right->isNil()) {
            return Value::nil();
        }

        // División por cero
        if (($rightType === 'int32' || $rightType === 'float32') && $right->getValue() == 0) {
            return Value::nil();
        }

        // int32 / int32 = int32
        if ($leftType === 'int32' && $rightType === 'int32') {
            return Value::int32(intdiv($left->getValue(), $right->getValue()));
        }

        // int32 / float32 = float32
        if ($leftType === 'int32' && $rightType === 'float32') {
            return Value::float32((float)$left->getValue() / $right->getValue());
        }

        // float32 / int32 = float32
        if ($leftType === 'float32' && $rightType === 'int32') {
            return Value::float32($left->getValue() / (float)$right->getValue());
        }

        // float32 / float32 = float32
        if ($leftType === 'float32' && $rightType === 'float32') {
            return Value::float32($left->getValue() / $right->getValue());
        }

        return Value::nil();
    }

    protected function performModulo(Value $left, Value $right): Value
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        if ($left->isNil() || $right->isNil()) {
            return Value::nil();
        }

        // Módulo por cero
        if (($rightType === 'int32' || $rightType === 'rune') && $right->getValue() == 0) {
            return Value::nil();
        }

        // int32 % int32 = int32
        if ($leftType === 'int32' && $rightType === 'int32') {
            return Value::int32($left->getValue() % $right->getValue());
        }

        // int32 % rune = int32
        if ($leftType === 'int32' && $rightType === 'rune') {
            return Value::int32($left->getValue() % $right->getValue());
        }

        // rune % int32 = int32
        if ($leftType === 'rune' && $rightType === 'int32') {
            return Value::int32($left->getValue() % $right->getValue());
        }

        return Value::nil();
    }

    /**
     * Operadores relacionales
     */
    protected function performComparison(string $operator, Value $left, Value $right): Value
    {
        if ($left->isNil() || $right->isNil()) {
            return Value::nil();
        }

        $leftType = $left->getType();
        $rightType = $right->getType();

        // Comparaciones válidas según las tablas
        $result = false;

        switch ($operator) {
            case '==':
            case '!=':
                $result = $this->compareEquality($left, $right, $operator === '==');
                break;
            case '>':
            case '>=':
            case '<':
            case '<=':
                $result = $this->compareRelational($operator, $left, $right);
                break;
        }

        return Value::bool($result);
    }

    private function compareEquality(Value $left, Value $right, bool $equals): bool
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        // Comparaciones válidas
        if (($leftType === 'int32' && ($rightType === 'int32' || $rightType === 'float32' || $rightType === 'rune')) ||
            ($leftType === 'float32' && ($rightType === 'int32' || $rightType === 'float32' || $rightType === 'rune')) ||
            ($leftType === 'rune' && ($rightType === 'int32' || $rightType === 'float32' || $rightType === 'rune')) ||
            ($leftType === 'string' && $rightType === 'string') ||
            ($leftType === 'bool' && $rightType === 'bool')) {
            
            $isEqual = $left->getValue() == $right->getValue();
            return $equals ? $isEqual : !$isEqual;
        }

        return false;
    }

    private function compareRelational(string $operator, Value $left, Value $right): bool
    {
        $leftType = $left->getType();
        $rightType = $right->getType();

        // Solo números y strings son comparables con >, <, >=, <=
        if (($leftType === 'int32' || $leftType === 'float32' || $leftType === 'rune') &&
            ($rightType === 'int32' || $rightType === 'float32' || $rightType === 'rune')) {
            
            $leftVal = $left->getValue();
            $rightVal = $right->getValue();

            switch ($operator) {
                case '>': return $leftVal > $rightVal;
                case '>=': return $leftVal >= $rightVal;
                case '<': return $leftVal < $rightVal;
                case '<=': return $leftVal <= $rightVal;
            }
        }

        if ($leftType === 'string' && $rightType === 'string') {
            $cmp = strcmp($left->getValue(), $right->getValue());
            switch ($operator) {
                case '>': return $cmp > 0;
                case '>=': return $cmp >= 0;
                case '<': return $cmp < 0;
                case '<=': return $cmp <= 0;
            }
        }

        return false;
    }

    /**
     * Operadores lógicos con cortocircuito
     */
    protected function performLogicalAnd(callable $leftEval, callable $rightEval): Value
    {
        $left = $leftEval();
        
        if (!$left instanceof Value) {
            return Value::nil();
        }

        // Cortocircuito: si left es false, no evaluar right
        if (!$left->toBool()) {
            return Value::bool(false);
        }

        $right = $rightEval();
        
        if (!$right instanceof Value) {
            return Value::nil();
        }

        return Value::bool($right->toBool());
    }

    protected function performLogicalOr(callable $leftEval, callable $rightEval): Value
    {
        $left = $leftEval();
        
        if (!$left instanceof Value) {
            return Value::nil();
        }

        // Cortocircuito: si left es true, no evaluar right
        if ($left->toBool()) {
            return Value::bool(true);
        }

        $right = $rightEval();
        
        if (!$right instanceof Value) {
            return Value::nil();
        }

        return Value::bool($right->toBool());
    }
}
