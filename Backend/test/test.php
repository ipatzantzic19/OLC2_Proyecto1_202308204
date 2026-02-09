<?php

/**
 * Script de prueba del intérprete de Golampi
 * Este archivo prueba las funcionalidades del intérprete incluyendo parsing de archivos .golampi
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar clases generadas por ANTLR
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';

use Golampi\Visitor\GolampiVisitor;
use Golampi\Runtime\Value;
use Golampi\Runtime\Environment;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

try {

    echo "=== INTÉRPRETE GOLAMPI - PRUEBAS ===\n\n";

    // ============================================================================
    // PRUEBA 1: Operaciones aritméticas directas
    // ============================================================================
    echo "1. Pruebas de operaciones aritméticas (directas):\n";

    $visitor = new GolampiVisitor();

    $test1 = $visitor->testPerformAddition(Value::int32(10), Value::int32(20));
    printf("   10 + 20 = %s (tipo: %s)\n", $test1->toString(), $test1->getType());

    $test2 = $visitor->testPerformAddition(Value::int32(10), Value::float32(3.5));
    printf("   10 + 3.5 = %s (tipo: %s)\n", $test2->toString(), $test2->getType());

    $test3 = $visitor->testPerformAddition(Value::string('Hola '), Value::string('Mundo'));
    printf("   'Hola ' + 'Mundo' = '%s'\n", $test3->toString());

    echo "\n";

    // ============================================================================
    // PRUEBA 2: Comparaciones directas
    // ============================================================================
    echo "2. Pruebas de comparaciones (directas):\n";

    $comp1 = $visitor->testPerformComparison('==', Value::int32(5), Value::int32(5));
    printf("   5 == 5 = %s\n", $comp1->toString());

    $comp2 = $visitor->testPerformComparison('!=', Value::int32(5), Value::int32(3));
    printf("   5 != 3 = %s\n", $comp2->toString());

    $comp3 = $visitor->testPerformComparison('>', Value::int32(10), Value::int32(5));
    printf("   10 > 5 = %s\n", $comp3->toString());

    echo "\n3. Parsing de archivo test1.golampi:\n";

    // Leer archivo
    $testFilePath = __DIR__ . '/test1.golampi';
    if (!file_exists($testFilePath)) {
        throw new Exception("Archivo no encontrado: $testFilePath");
    }

    $sourceCode = file_get_contents($testFilePath);
    echo "   ✓ Archivo leído: " . strlen($sourceCode) . " caracteres\n";
    echo "   Contenido:\n";
    foreach (explode("\n", $sourceCode) as $line) {
        if (!empty(trim($line))) {
            echo "      " . trim($line) . "\n";
        }
    }

    echo "\n4. Análisis léxico y sintáctico:\n";

    // Crear input stream desde el contenido del archivo
    $input = InputStream::fromString($sourceCode);
    echo "   ✓ InputStream creado\n";

    // Crear lexer
    $lexer = new \GolampiLexer($input);
    echo "   ✓ Lexer instanciado\n";

    // Crear token stream
    $tokens = new CommonTokenStream($lexer);
    echo "   ✓ CommonTokenStream creado\n";

    // Crear parser
    $parser = new \GolampiParser($tokens);
    echo "   ✓ Parser instanciado\n";

    // Obtener el árbol sintáctico
    $tree = $parser->program();
    echo "   ✓ Árbol sintáctico generado\n";

    echo "\n5. Ejecución del visitor:\n";

    // Crear e instanciar el visitor
    $visitor = new GolampiVisitor();
    echo "   ✓ Visitor instanciado\n";

    // Visitar el árbol
    $result = $visitor->visit($tree);
    echo "   ✓ Árbol visitado\n";

    // Obtener resultados
    $output = $visitor->getOutputString();
    $errors = $visitor->getErrors();

    echo "\n6. Resultados de la ejecución:\n";
    if (!empty($output)) {
        echo "   📤 Salida del programa:\n";
        foreach (explode("\n", $output) as $line) {
            if (!empty(trim($line))) {
                echo "      " . trim($line) . "\n";
            }
        }
    } else {
        echo "   📤 (Sin salida)\n";
    }

    echo "\n7. Tabla de Símbolos:\n";
    $symbolTable = $visitor->getSymbolTable();
    if (!empty($symbolTable)) {
        echo "   Total de símbolos: " . count($symbolTable) . "\n";
        foreach ($symbolTable as $idx => $sym) {
            $val = $sym['value'] instanceof Value
                ? $sym['value']->toString()
                : (string)$sym['value'];

            echo "   [" . ($idx + 1) . "] "
               . $sym['identifier']
               . " (" . $sym['type'] . ") = "
               . $val
               . " [Scope: " . $sym['scope'] . "]\n";
        }
    } else {
        echo "   (Tabla vacía)\n";
    }

    echo "\n8. Análisis de Errores:\n";
    if (!empty($errors)) {
        echo "   ❌ Errores encontrados: " . count($errors) . "\n";
        foreach ($errors as $idx => $error) {
            echo "   [" . ($idx + 1) . "] "
               . "[" . $error['type'] . "] "
               . "Línea " . $error['line']
               . " Col " . $error['column']
               . ": " . $error['description'] . "\n";
        }
    } else {
        echo "   ✅ Sin errores encontrados\n";
    }

    echo "\n=== PRUEBA COMPLETADA EXITOSAMENTE ===\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString() . "\n";
}
