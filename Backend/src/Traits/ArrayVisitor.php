<?php

namespace Golampi\Traits;

use Golampi\Runtime\Value;

/**
 * Trait para manejar arreglos en el intérprete Golampi.
 *
 * Cubre:
 *  - Creación de arreglos desde contexto de tipo   (createArrayFromTypeCtx)
 *  - Creación con valores iniciales                (visitArrayLiteralExpr / visitArrayLiteral)
 *  - Literales internos sin tipo                   (visitInnerArrayLiteral)
 *  - Acceso a elementos (1..N dimensiones)         (visitArrayAccess)
 *  - Asignación a elementos (1..N dimensiones)     (visitArrayAssignment)
 *  - Longitud de arreglo                           (integrada en len())
 */
trait ArrayVisitor
{
    // =========================================================
    //  DETECCIÓN DE TIPO ARREGLO
    // =========================================================

    /**
     * Devuelve true si el contexto de tipo corresponde a un arreglo.
     * Detecta la forma '[' expression ']' type.
     */
    protected function isArrayTypeCtx($typeCtx): bool
    {
        if ($typeCtx === null) {
            return false;
        }
        return str_starts_with(trim($typeCtx->getText()), '[');
    }

    // =========================================================
    //  CONSTRUCCIÓN DE ARREGLOS DESDE TIPO
    // =========================================================

    /**
     * Crea un Value de tipo 'array' con sus valores por defecto
     * a partir de un contexto de tipo arreglo (ArrayType en la gramática).
     *
     * Soporta cualquier nivel de multidimensionalidad.
     */
    protected function createArrayFromTypeCtx($typeCtx): Value
    {
        // Evaluar la expresión del tamaño
        $sizeValue = $this->visit($typeCtx->expression());
        $size      = (int) $sizeValue->getValue();

        if ($size <= 0) {
            $this->addSemanticError(
                "El tamaño del arreglo debe ser un entero positivo, se obtuvo: $size",
                $typeCtx->getStart()->getLine(),
                $typeCtx->getStart()->getCharPositionInLine()
            );
            $size = 0;
        }

        $innerTypeCtx  = $typeCtx->type();
        $isNestedArray = $this->isArrayTypeCtx($innerTypeCtx);
        $elementType   = $isNestedArray ? 'array' : $this->extractType($innerTypeCtx);

        // Crear elementos con valor por defecto
        $elements = [];
        for ($i = 0; $i < $size; $i++) {
            $elements[] = $isNestedArray
                ? $this->createArrayFromTypeCtx($innerTypeCtx)
                : $this->getDefaultValue($elementType);
        }

        return new Value('array', [
            'elementType' => $elementType,
            'size'        => $size,
            'elements'    => $elements,
        ]);
    }

    /**
     * Crea un arreglo a partir de dimensiones explícitas y tipo base.
     * Útil cuando ya se evaluaron las dimensiones (p.ej. desde arrayLiteral).
     *
     * @param int[]       $dims      Lista de dimensiones [d0, d1, …]
     * @param string      $baseType  Tipo primitivo de los elementos hoja
     * @param Value[]|null $initVals Valores iniciales para el primer nivel (opcional)
     */
    protected function createArrayFromDims(array $dims, string $baseType, ?array $initVals = null): Value
    {
        $size          = $dims[0];
        $remainingDims = array_slice($dims, 1);
        $isNested      = count($remainingDims) > 0;
        $elementType   = $isNested ? 'array' : $baseType;

        $elements = [];
        for ($i = 0; $i < $size; $i++) {
            if ($initVals !== null && isset($initVals[$i])) {
                $el = $initVals[$i];
                // Si el valor ya es un arreglo, úsalo directamente
                if ($el->getType() === 'array') {
                    $elements[] = $el;
                    continue;
                }
            }

            if ($isNested) {
                $elements[] = $this->createArrayFromDims($remainingDims, $baseType);
            } else {
                $elements[] = ($initVals !== null && isset($initVals[$i]))
                    ? $initVals[$i]
                    : $this->getDefaultValue($baseType);
            }
        }

        return new Value('array', [
            'elementType' => $elementType,
            'size'        => $size,
            'elements'    => $elements,
        ]);
    }

    // =========================================================
    //  LITERALES DE ARREGLO
    // =========================================================

    /**
     * Visita un literal de arreglo como expresión primaria.
     * Delega a visitArrayLiteralNode.
     */
    public function visitArrayLiteralExpr($context)
    {
        return $this->visitArrayLiteralNode($context->arrayLiteral());
    }

    /**
     * Procesa un nodo arrayLiteral:
     *   '[' expression ']' type '{' (expressionList | innerLiteralList)? '}'
     *
     * Ejemplos:
     *   [3]int32{1, 2, 3}
     *   [2][2]int32{{1,2},{3,4}}
     */
    public function visitArrayLiteralNode($context)
    {
        // Tamaño de la primera dimensión
        $sizeValue = $this->visit($context->expression());
        $size      = (int) $sizeValue->getValue();

        $typeCtx       = $context->type();
        $isNestedArray = $this->isArrayTypeCtx($typeCtx);
        $elementType   = $isNestedArray ? 'array' : $this->extractType($typeCtx);

        $elements = [];

        // ── Inicialización con lista de literales internos {{…},{…}} ──
        if ($context->innerLiteralList() !== null) {
            $innerList = $context->innerLiteralList()->innerLiteral();
            foreach ($innerList as $inner) {
                $elements[] = $this->buildInnerArray($inner->expressionList(), $typeCtx);
            }
        }
        // ── Inicialización plana {e1, e2, …} ──
        elseif ($context->expressionList() !== null) {
            $exprList = $context->expressionList();
            for ($i = 0; $i < $exprList->getChildCount(); $i += 2) {
                $elements[] = $this->visit($exprList->getChild($i));
            }
        }

        // Completar con valores por defecto
        while (count($elements) < $size) {
            $elements[] = $isNestedArray
                ? $this->createArrayFromTypeCtx($typeCtx)
                : $this->getDefaultValue($elementType);
        }

        return new Value('array', [
            'elementType' => $elementType,
            'size'        => $size,
            'elements'    => $elements,
        ]);
    }

    /**
     * Construye un arreglo interno a partir de su lista de expresiones
     * y el tipo esperado del elemento.
     */
    private function buildInnerArray($expressionListCtx, $expectedTypeCtx): Value
    {
        $elements = [];

        if ($expressionListCtx !== null) {
            for ($i = 0; $i < $expressionListCtx->getChildCount(); $i += 2) {
                $elements[] = $this->visit($expressionListCtx->getChild($i));
            }
        }

        $isNested    = $this->isArrayTypeCtx($expectedTypeCtx);
        $elementType = $isNested ? 'array' : $this->extractType($expectedTypeCtx);

        return new Value('array', [
            'elementType' => $elementType,
            'size'        => count($elements),
            'elements'    => $elements,
        ]);
    }

    /**
     * Visita un literal de arreglo interno sin tipo:
     *   '{' expressionList '}'
     *
     * Se usa dentro de arreglos multidimensionales cuando el tipo
     * se infiere del contexto.
     */
    public function visitInnerArrayLiteral($context)
    {
        $elements    = [];
        $elementType = 'nil';

        if ($context->expressionList() !== null) {
            $exprList = $context->expressionList();
            for ($i = 0; $i < $exprList->getChildCount(); $i += 2) {
                $val      = $this->visit($exprList->getChild($i));
                $elements[] = $val;
            }

            if (count($elements) > 0) {
                $elementType = $elements[0]->getType();
            }
        }

        return new Value('array', [
            'elementType' => $elementType,
            'size'        => count($elements),
            'elements'    => $elements,
        ]);
    }

    // =========================================================
    //  ACCESO A ELEMENTOS (LECTURA)
    // =========================================================

    /**
     * Visita el acceso a uno o varios índices de arreglo:
     *   ID '[' expr ']'
     *   ID '[' expr ']' '[' expr ']'
     *   …
     */
    public function visitArrayAccess($context)
    {
        $varName = $context->ID()->getText();
        $line    = $context->getStart()->getLine();
        $col     = $context->getStart()->getCharPositionInLine();

        $arr = $this->environment->get($varName);

        if ($arr === null) {
            $this->addSemanticError("Variable '$varName' no declarada", $line, $col);
            return Value::nil();
        }

        if ($arr->getType() !== 'array') {
            $this->addSemanticError(
                "La variable '$varName' no es un arreglo (tipo: '{$arr->getType()}')",
                $line, $col
            );
            return Value::nil();
        }

        // Evaluar todos los índices en orden
        $indices = [];
        foreach ($context->expression() as $exprCtx) {
            $idxVal = $this->visit($exprCtx);
            if ($idxVal === null || !in_array($idxVal->getType(), ['int32', 'rune'])) {
                $this->addSemanticError(
                    "El índice del arreglo debe ser de tipo int32 o rune",
                    $exprCtx->getStart()->getLine(),
                    $exprCtx->getStart()->getCharPositionInLine()
                );
                return Value::nil();
            }
            $indices[] = (int) $idxVal->getValue();
        }

        return $this->getArrayElement($arr, $indices, $varName, $line, $col);
    }

    // =========================================================
    //  ACCESO A ELEMENTOS (ESCRITURA)
    // =========================================================

    /**
     * Visita la asignación a un elemento de arreglo:
     *   ID '[' idx ']' (('[' idx ']')*) assignOp expression
     *
     * Todas las expressiones son devueltas por context->expression().
     * Las N-1 primeras son índices; la última es el valor.
     */
    public function visitArrayAssignment($context)
    {
        $varName  = $context->ID()->getText();
        $assignOp = $context->assignOp()->getText();
        $line     = $context->getStart()->getLine();
        $col      = $context->getStart()->getCharPositionInLine();

        // Obtener el arreglo del entorno
        $arr = $this->environment->get($varName);

        if ($arr === null) {
            $this->addSemanticError("Variable '$varName' no declarada", $line, $col);
            return null;
        }

        if ($arr->getType() !== 'array') {
            $this->addSemanticError(
                "La variable '$varName' no es un arreglo (tipo: '{$arr->getType()}')",
                $line, $col
            );
            return null;
        }

        // Separar índices del valor
        $allExprs  = $context->expression();
        $totalExpr = count($allExprs);

        // El último es el valor; los anteriores son índices
        $indexExprs = array_slice($allExprs, 0, $totalExpr - 1);
        $valueExpr  = $allExprs[$totalExpr - 1];

        // Evaluar índices
        $indices = [];
        foreach ($indexExprs as $idxCtx) {
            $idxVal = $this->visit($idxCtx);
            if ($idxVal === null || !in_array($idxVal->getType(), ['int32', 'rune'])) {
                $this->addSemanticError(
                    "El índice del arreglo debe ser de tipo int32 o rune",
                    $idxCtx->getStart()->getLine(),
                    $idxCtx->getStart()->getCharPositionInLine()
                );
                return null;
            }
            $indices[] = (int) $idxVal->getValue();
        }

        // Evaluar nuevo valor
        $newValue = $this->visit($valueExpr);

        // Para asignaciones compuestas, leer el valor actual
        if ($assignOp !== '=') {
            $currentEl = $this->getArrayElement($arr, $indices, $varName, $line, $col);
            if ($currentEl === null) {
                return null;
            }
            $newValue = match ($assignOp) {
                '+=' => $this->performAddition($currentEl, $newValue, $line, $col),
                '-=' => $this->performSubtraction($currentEl, $newValue, $line, $col),
                '*=' => $this->performMultiplication($currentEl, $newValue, $line, $col),
                '/=' => $this->performDivision($currentEl, $newValue, $line, $col),
                default => $newValue,
            };
        }

        // Mutar el arreglo en su lugar
        $success = $this->setArrayElement($arr, $indices, $newValue, $varName, $line, $col);

        if ($success) {
            // Actualizar el valor en la tabla de símbolos para el reporte
            $this->updateSymbolValue($varName, $arr);
        }

        return null;
    }

    // =========================================================
    //  HELPERS DE LECTURA / ESCRITURA
    // =========================================================

    /**
     * Recupera el elemento en las posiciones indicadas por $indices.
     * Genera error semántico y devuelve nil si el índice está fuera de rango.
     */
    protected function getArrayElement(
        Value  $arr,
        array  $indices,
        string $varName = '?',
        int    $line    = 0,
        int    $col     = 0
    ): Value {
        $current = $arr;

        foreach ($indices as $depth => $idx) {
            if ($current->getType() !== 'array') {
                $this->addSemanticError(
                    "Acceso de índice en un valor que no es arreglo (variable '$varName')",
                    $line, $col
                );
                return Value::nil();
            }

            $data = $current->getValue();
            $size = $data['size'];

            if ($idx < 0 || $idx >= $size) {
                $this->addSemanticError(
                    "Índice $idx fuera de rango (tamaño: $size) en '$varName'",
                    $line, $col
                );
                return Value::nil();
            }

            $current = $data['elements'][$idx];
        }

        return $current;
    }

    /**
     * Establece el elemento en la posición indicada por $indices.
     * Muta el Value en su lugar (PHP pasa objetos por referencia de handle).
     * Devuelve true si tuvo éxito.
     */
    protected function setArrayElement(
        Value  $arr,
        array  $indices,
        Value  $newValue,
        string $varName = '?',
        int    $line    = 0,
        int    $col     = 0
    ): bool {
        if (count($indices) === 1) {
            // Caso base: asignar directamente
            $data = $arr->getValue();
            $idx  = $indices[0];

            if ($idx < 0 || $idx >= $data['size']) {
                $this->addSemanticError(
                    "Índice $idx fuera de rango (tamaño: {$data['size']}) en '$varName'",
                    $line, $col
                );
                return false;
            }

            $data['elements'][$idx] = $newValue;
            $arr->setValue($data);
            return true;
        }

        // Caso recursivo: navegar hacia el sub-arreglo
        $data = $arr->getValue();
        $idx  = $indices[0];

        if ($idx < 0 || $idx >= $data['size']) {
            $this->addSemanticError(
                "Índice $idx fuera de rango (tamaño: {$data['size']}) en '$varName'",
                $line, $col
            );
            return false;
        }

        $subArr = $data['elements'][$idx];

        if ($subArr->getType() !== 'array') {
            $this->addSemanticError(
                "Acceso de índice en un valor que no es arreglo (variable '$varName')",
                $line, $col
            );
            return false;
        }

        $success = $this->setArrayElement(
            $subArr,
            array_slice($indices, 1),
            $newValue,
            $varName,
            $line,
            $col
        );

        if ($success) {
            // Actualizar la referencia en el nivel actual
            $data['elements'][$idx] = $subArr;
            $arr->setValue($data);
        }

        return $success;
    }

    // =========================================================
    //  FORMATO PARA SALIDA / TABLA DE SÍMBOLOS
    // =========================================================

    /**
     * Convierte un Value de tipo 'array' en su representación de texto,
     * útil para fmt.Println y para el reporte de tabla de símbolos.
     */
    public function arrayToString(Value $arr, bool $compact = false): string
    {
        if ($arr->getType() !== 'array') {
            return $arr->toString();
        }

        $data     = $arr->getValue();
        $elements = $data['elements'];
        $parts    = [];

        foreach ($elements as $el) {
            if ($el->getType() === 'array') {
                $parts[] = $this->arrayToString($el, $compact);
            } else {
                $parts[] = $el->toString();
            }
        }

        return $compact
            ? '{' . implode(',', $parts) . '}'
            : '[' . implode(' ', $parts) . ']';
    }
}