<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para visitar declaraciones del AST
 */
trait DeclarationVisitor
{
    /**
     * Visita una declaración de variable con inicialización
     */
    public function visitVarDeclWithInit($context)
    {
        $idList = $context->idList();
        $typeCtx = $context->type();
        $expressionList = $context->expressionList();
        
        $type = $this->extractType($typeCtx);
        
        $ids = [];
        if ($idList->getChildCount() > 0) {
            for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
                $id = $idList->getChild($i)->getText();
                $ids[] = $id;
            }
        }
        
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
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }
        
        for ($i = 0; $i < count($ids); $i++) {
            $value = $expressions[$i] ?? Value::nil();
            
            // Verificar si la variable ya existe en el scope actual
            if ($this->symbolExistsInCurrentScope($ids[$i])) {
                $this->addSemanticError(
                    "Variable '{$ids[$i]}' ya ha sido declarada en el ámbito actual",
                    $context->getStart()->getLine(),
                    $context->getStart()->getCharPositionInLine()
                );
                continue;
            }
            
            // Verificar compatibilidad de tipos
            if (!$value->isNil() && $value->getType() !== $type) {
                $this->addSemanticError(
                    "Incompatibilidad de tipos: se esperaba '$type' pero se obtuvo '{$value->getType()}'",
                    $context->getStart()->getLine(),
                    $context->getStart()->getCharPositionInLine()
                );
            }
            
            $this->environment->define($ids[$i], $value);
            
            $this->addSymbol(
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
        $idList = $context->idList();
        $typeCtx = $context->type();
        
        $type = $this->extractType($typeCtx);
        $ids = [];
        
        if ($idList->getChildCount() > 0) {
            for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
                $id = $idList->getChild($i)->getText();
                $ids[] = $id;
            }
        }
        
        foreach ($ids as $id) {
            // Verificar si la variable ya existe en el scope actual
            if ($this->symbolExistsInCurrentScope($id)) {
                $this->addSemanticError(
                    "Variable '$id' ya ha sido declarada en el ámbito actual",
                    $context->getStart()->getLine(),
                    $context->getStart()->getCharPositionInLine()
                );
                continue;
            }
            
            $defaultValue = $this->getDefaultValue($type);
            $this->environment->define($id, $defaultValue);
            
            $this->addSymbol(
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
     * Visita un identificador (variable)
     */
    public function visitIdentifier($context)
    {
        $varName = $context->ID()->getText();
        $value = $this->environment->get($varName);
        
        if ($value === null) {
            $this->addSemanticError(
                "Variable '$varName' no declarada",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return Value::nil();
        }
        
        return $value;
    }

    /**
     * Extrae el tipo de un contexto de tipo
     */
    protected function extractType($typeCtx): string
    {
        if ($typeCtx === null) {
            return 'nil';
        }
        
        $text = $typeCtx->getText();
        
        return match ($text) {
            'int32' => 'int32',
            'float32' => 'float32',
            'bool' => 'bool',
            'string' => 'string',
            'rune' => 'rune',
            default => 'nil',
        };
    }

    /**
     * Obtiene el valor por defecto para un tipo
     */
    protected function getDefaultValue(string $type): Value
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
}