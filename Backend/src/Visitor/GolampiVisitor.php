<?php

namespace Golampi\Visitor;
use Golampi\Runtime\Value;

/**
 * Este será el visitor principal que extenderá el visitor generado por ANTLR
 * Aquí implementaremos los métodos visit* para cada regla de la gramática
 */
class GolampiVisitor extends BaseVisitor
{
    public function __construct()
    {
        parent::__construct();

        // Registrar el espacio de nombres `fmt` como una variable especial
        $this->environment->define('fmt', Value::string('namespace'));
        $this->addSymbolPublic('fmt', 'namespace', 'global', Value::string('namespace'), 0, 0);
    }

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
        // Validar que los argumentos sean instancias de Value
        if (!$left instanceof Value || !$right instanceof Value) {
            throw new \TypeError(sprintf(
                "performComparison(): Ambos argumentos deben ser instancias de 'Golampi\\Runtime\\Value', se recibieron '%s' y '%s'.",
                is_object($left) ? get_class($left) : gettype($left),
                is_object($right) ? get_class($right) : gettype($right)
            ));
        }

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

    /**
     * Métodos públicos para testing - versiones públicas de operaciones protegidas
     */
    public function testPerformAddition(Value $left, Value $right): Value
    {
        return $this->performAddition($left, $right);
    }

    public function testPerformComparison(string $operator, Value $left, Value $right): Value
    {
        return $this->performComparison($operator, $left, $right);
    }

    /**
     * ==================== MÉTODOS VISIT PARA INTERPRETAR EL CÓDIGO ====================
     */

    /**
     * Visita el programa principal
     */
    public function visitProgram($context)
    {
        // Procesar todas las declaraciones
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
     * Visita una declaración de variable con inicialización
     */
    public function visitVarDeclWithInit($context)
    {
        // var x int32 = 10
        $idList = $context->idList();
        $typeCtx = $context->type();
        $expressionList = $context->expressionList();
        
        // Obtener tipo
        $type = $this->extractType($typeCtx);
        
        $ids = [];
        // Obtener lista de identificadores
        if ($idList->getChildCount() > 0) {
            for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
                $id = $idList->getChild($i)->getText();
                $ids[] = $id;
            }
        }
        
        // Evaluar expresiones
        $expressions = [];
        if ($expressionList->getChildCount() > 0) {
            for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
                $expr = $this->visit($expressionList->getChild($i));
                $expressions[] = $expr;
            }
        }
        
        // Definir variables en el entorno
        for ($i = 0; $i < count($ids); $i++) {
            $value = $expressions[$i] ?? Value::nil();
            $this->environment->define($ids[$i], $value);
            
            // Agregar a tabla de símbolos
            $this->addSymbolPublic(
                $ids[$i],
                $type,
                $this->getCurrentScopeName(),
                $value,
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
        }
        
        return null;
    }

    /**
     * Visita una declaración de variable simple (sin inicialización)
     */
    public function visitVarDeclSimple($context)
    {
        // var x int32
        $idList = $context->idList();
        $typeCtx = $context->type();
        
        $type = $typeCtx->getText();
        $ids = [];
        
        if ($idList->getChildCount() > 0) {
            for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
                $id = $idList->getChild($i)->getText();
                $ids[] = $id;
            }
        }
        
        // Definir variables con valor por defecto
        foreach ($ids as $id) {
            $defaultValue = $this->getDefaultValue($type);
            $this->environment->define($id, $defaultValue);
            
            $this->addSymbolPublic(
                $id,
                $type,
                $this->getCurrentScopeName(),
                $defaultValue,
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
        }
        
        return null;
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
     * Visita un bloque de código
     */
    public function visitBlock($context)
    {
        // Procesar declaraciones dentro del bloque
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
     * Visita una sentencia de expresión (ej: fmt.Println(...))
     */
    public function visitExpressionStatement($context)
    {
        return $this->visit($context->expression());
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

    return Value::nil();
}


    /**
     * Visita un identificador (variable)
     */
    public function visitIdentifier($context)
    {
        $varName = $context->ID()->getText();
        $value = $this->environment->get($varName);
        
        if ($value === null) {
            $this->addSemanticError("Variable no definida: $varName", $context->getStart()->getLine(), $context->getStart()->getCharPositionInLine());
            return Value::nil();
        }
        
        return $value;
    }

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
        
        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            $op = $context->getChild($i)->getText();
            $right = $this->visit($context->multiplicative($i / 2));
            
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
        
        for ($i = 1; $i < $context->getChildCount(); $i += 2) {
            $op = $context->getChild($i)->getText();
            $right = $this->visit($context->unary($i / 2));
            
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
    // 🔑 CASO SIN &&
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
    // 🔑 CASO SIN ||
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


    /**
     * Método público para agregar un símbolo a la tabla de símbolos.
     * Este método actúa como un proxy para el método protegido `addSymbol()`.
     */
    public function addSymbolPublic(
        string $name,
        string $type,
        string $scope,
        Value $value,
        int $line,
        int $column
    ): void {
        $this->addSymbol($name, $type, $scope, $value, $line, $column);
    }

    /**
     * Obtiene el valor por defecto para un tipo
     */
    private function getDefaultValue(string $type): Value
    {
        return match ($type) {
            'int32' => Value::int32(0),
            'float32' => Value::float32(0.0),
            'bool' => Value::bool(false),
            'string' => Value::string(''),
            'rune' => Value::rune(0),
            default => Value::nil(),
        };
    }

    /**
     * Extrae el tipo de un contexto de tipo
     */
    private function extractType($typeCtx): string
    {
        if ($typeCtx === null) {
            return 'nil';
        }
        
        $text = $typeCtx->getText();
        
        // Mapear tipos de la gramática a nombres amigables
        return match ($text) {
            'int32' => 'int32',
            'float32' => 'float32',
            'bool' => 'bool',
            'string' => 'string',
            'rune' => 'rune',
            default => 'nil',
        };
    }
}


