<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para visitar declaraciones del AST.
 * Actualizado para soportar arreglos simples y multidimensionales.
 */
trait DeclarationVisitor
{
    // =========================================================
    //  VAR CON INICIALIZACIÓN
    // =========================================================

    /**
     * var x int32 = 10
     * var a [5]int32 = [5]int32{1,2,3,4,5}
     * var m [2][3]int32 = [2][3]int32{{1,2,3},{4,5,6}}
     */
    public function visitVarDeclWithInit($context)
    {
        $idList         = $context->idList();
        $typeCtx        = $context->type();
        $expressionList = $context->expressionList();

        $isArray = $this->isArrayTypeCtx($typeCtx);
        $type    = $isArray ? 'array' : $this->extractType($typeCtx);

        // Extraer identificadores
        $ids = [];
        for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
            $ids[] = $idList->getChild($i)->getText();
        }

        // Evaluar expresiones del lado derecho
        $expressions = [];
        for ($i = 0; $i < $expressionList->getChildCount(); $i += 2) {
            $expressions[] = $this->visit($expressionList->getChild($i));
        }

        if (count($ids) !== count($expressions)) {
            $this->addSemanticError(
                "Número de variables (" . count($ids) . ") no coincide con número de valores (" . count($expressions) . ")",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }

        for ($i = 0; $i < count($ids); $i++) {
            $varName = $ids[$i];
            $value   = $expressions[$i];

            if ($this->symbolExistsInCurrentScope($varName)) {
                $this->addSemanticError(
                    "Variable '$varName' ya ha sido declarada en el ámbito actual",
                    $context->getStart()->getLine(),
                    $context->getStart()->getCharPositionInLine()
                );
                continue;
            }

            // Verificar compatibilidad de tipo
            if (!$value->isNil()) {
                if ($isArray && $value->getType() !== 'array') {
                    $this->addSemanticError(
                        "Incompatibilidad de tipos: se esperaba un arreglo pero se obtuvo '{$value->getType()}'",
                        $context->getStart()->getLine(),
                        $context->getStart()->getCharPositionInLine()
                    );
                } elseif (!$isArray && $value->getType() !== $type) {
                    $this->addSemanticError(
                        "Incompatibilidad de tipos: se esperaba '$type' pero se obtuvo '{$value->getType()}'",
                        $context->getStart()->getLine(),
                        $context->getStart()->getCharPositionInLine()
                    );
                }
            }

            $this->environment->define($varName, $value);

            $this->addSymbol(
                $varName,
                $this->buildTypeLabel($typeCtx),
                $this->getCurrentScopeName(),
                $value,
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
        }

        return null;
    }

    // =========================================================
    //  VAR SIN INICIALIZACIÓN
    // =========================================================

    /**
     * var x int32
     * var a [5]int32
     * var m [2][3]int32
     */
    public function visitVarDeclSimple($context)
    {
        $idList  = $context->idList();
        $typeCtx = $context->type();

        $isArray = $this->isArrayTypeCtx($typeCtx);
        $type    = $isArray ? 'array' : $this->extractType($typeCtx);

        $ids = [];
        for ($i = 0; $i < $idList->getChildCount(); $i += 2) {
            $ids[] = $idList->getChild($i)->getText();
        }

        foreach ($ids as $id) {
            if ($this->symbolExistsInCurrentScope($id)) {
                $this->addSemanticError(
                    "Variable '$id' ya ha sido declarada en el ámbito actual",
                    $context->getStart()->getLine(),
                    $context->getStart()->getCharPositionInLine()
                );
                continue;
            }

            // Crear valor por defecto (arreglo inicializado o primitivo)
            $defaultValue = $isArray
                ? $this->createArrayFromTypeCtx($typeCtx)
                : $this->getDefaultValue($type);

            $this->environment->define($id, $defaultValue);

            $this->addSymbol(
                $id,
                $this->buildTypeLabel($typeCtx),
                $this->getCurrentScopeName(),
                $defaultValue,
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
        }

        return null;
    }

    // =========================================================
    //  CONSTANTES
    // =========================================================

    public function visitConstDecl($context)
    {
        $id      = $context->ID()->getText();
        $typeCtx = $context->type();
        $type    = $this->extractType($typeCtx);
        $value   = $this->visit($context->expression());

        if ($this->symbolExistsInCurrentScope($id)) {
            $this->addSemanticError(
                "Constante '$id' ya ha sido declarada en el ámbito actual",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
            return null;
        }

        if (!$value->isNil() && $value->getType() !== $type) {
            $this->addSemanticError(
                "Incompatibilidad de tipos en constante '$id': se esperaba '$type' pero se obtuvo '{$value->getType()}'",
                $context->getStart()->getLine(),
                $context->getStart()->getCharPositionInLine()
            );
        }

        // Las constantes se almacenan como valores inmutables
        $this->environment->define($id, $value);

        $this->addSymbol(
            $id,
            $type . ' (const)',
            $this->getCurrentScopeName(),
            $value,
            $context->getStart()->getLine(),
            $context->getStart()->getCharPositionInLine()
        );

        return null;
    }

    // =========================================================
    //  IDENTIFICADOR (LECTURA)
    // =========================================================

    public function visitIdentifier($context)
    {
        $varName = $context->ID()->getText();
        $value   = $this->environment->get($varName);

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

    // =========================================================
    //  HELPERS DE TIPO
    // =========================================================

    /**
     * Extrae el tipo base como string ('int32', 'float32', etc.).
     * Para arreglos devuelve 'array'.
     */
    protected function extractType($typeCtx): string
    {
        if ($typeCtx === null) {
            return 'nil';
        }

        if ($this->isArrayTypeCtx($typeCtx)) {
            return 'array';
        }

        $text = $typeCtx->getText();

        return match ($text) {
            'int32'   => 'int32',
            'float32' => 'float32',
            'bool'    => 'bool',
            'string'  => 'string',
            'rune'    => 'rune',
            default   => 'nil',
        };
    }

    /**
     * Construye la etiqueta legible del tipo para la tabla de símbolos.
     * Ejemplos: 'int32', '[5]int32', '[2][3]int32'
     */
    protected function buildTypeLabel($typeCtx): string
    {
        if ($typeCtx === null) {
            return 'nil';
        }
        return $typeCtx->getText();
    }

    /**
     * Devuelve el valor por defecto para un tipo primitivo.
     */
    protected function getDefaultValue(string $type): Value
    {
        return match ($type) {
            'int32'   => Value::int32(0),
            'float32' => Value::float32(0.0),
            'bool'    => Value::bool(false),
            'string'  => Value::string(''),
            'rune'    => Value::rune(0),
            default   => Value::nil(),
        };
    }
}