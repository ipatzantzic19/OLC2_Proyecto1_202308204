<?php

/**
 * Script de prueba del intérprete de Golampi
 * Analiza archivos .golampi y maneja errores, salidas y reportes
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Cargar clases generadas por ANTLR
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';

use Golampi\Visitor\GolampiVisitor;
use Golampi\Runtime\Value;
use Golampi\Traits\ErrorHandler;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

/**
 * Clase para manejar errores de ANTLR
 */
class ErrorListener extends \Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener
{
    use ErrorHandler;

    public function syntaxError(\Antlr\Antlr4\Runtime\Recognizer $recognizer, ?object $offendingSymbol, int $line, int $charPositionInLine, string $msg, ?\Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException $exception): void
    {
        $this->addSyntacticError($msg, $line, $charPositionInLine);
    }
}

/**
 * Función para formatear la tabla de errores
 */
function formatErrorTable(array $errors): string
{
    if (empty($errors)) {
        return "✅ Sin errores\n";
    }

    $output = "\n" . str_repeat("=", 100) . "\n";
    $output .= "REPORTE DE ERRORES\n";
    $output .= str_repeat("=", 100) . "\n";
    $output .= sprintf("%-5s %-15s %-60s %-8s %-8s\n", "#", "Tipo", "Descripción", "Línea", "Columna");
    $output .= str_repeat("-", 100) . "\n";

    foreach ($errors as $idx => $error) {
        $output .= sprintf(
            "%-5s %-15s %-60s %-8s %-8s\n",
            $idx + 1,
            $error['type'],
            substr($error['description'], 0, 60),
            $error['line'],
            $error['column']
        );
    }

    $output .= str_repeat("=", 100) . "\n";
    return $output;
}

/**
 * Función para formatear la tabla de símbolos
 */
function formatSymbolTable(array $symbols): string
{
    if (empty($symbols)) {
        return "⚠️  Tabla de símbolos vacía\n";
    }

    $output = "\n" . str_repeat("=", 120) . "\n";
    $output .= "TABLA DE SÍMBOLOS\n";
    $output .= str_repeat("=", 120) . "\n";
    $output .= sprintf("%-20s %-15s %-15s %-30s %-8s %-8s\n", 
        "Identificador", "Tipo", "Ámbito", "Valor", "Línea", "Columna");
    $output .= str_repeat("-", 120) . "\n";

    foreach ($symbols as $symbol) {
        $value = $symbol['value'] instanceof Value
            ? $symbol['value']->toString()
            : (string)$symbol['value'];

        $output .= sprintf(
            "%-20s %-15s %-15s %-30s %-8s %-8s\n",
            substr($symbol['identifier'], 0, 20),
            substr($symbol['type'], 0, 15),
            substr($symbol['scope'], 0, 15),
            substr($value, 0, 30),
            $symbol['line'],
            $symbol['column']
        );
    }

    $output .= str_repeat("=", 120) . "\n";
    return $output;
}

/**
 * Función para ejecutar un archivo Golampi
 */
function executeGolampiFile(string $filePath): array
{
    $result = [
        'success' => false,
        'output' => '',
        'errors' => [],
        'symbolTable' => [],
        'executionTime' => 0,
        'message' => ''
    ];

    $startTime = microtime(true);

    try {
        // Verificar que el archivo existe
        if (!file_exists($filePath)) {
            throw new Exception("Archivo no encontrado: $filePath");
        }

        // Leer el código fuente
        $sourceCode = file_get_contents($filePath);
        
        if ($sourceCode === false) {
            throw new Exception("Error al leer el archivo: $filePath");
        }

        echo "\n📄 Archivo: " . basename($filePath) . "\n";
        echo "📊 Tamaño: " . strlen($sourceCode) . " caracteres\n";
        echo "📝 Líneas: " . substr_count($sourceCode, "\n") + 1 . "\n\n";

        // Crear input stream
        $input = InputStream::fromString($sourceCode);

        // Crear lexer con error listener
        $lexer = new \GolampiLexer($input);
        $lexerErrorListener = new ErrorListener();
        $lexer->removeErrorListeners();
        $lexer->addErrorListener($lexerErrorListener);

        // Crear token stream
        $tokens = new CommonTokenStream($lexer);

        // Crear parser con error listener
        $parser = new \GolampiParser($tokens);
        $parserErrorListener = new ErrorListener();
        $parser->removeErrorListeners();
        $parser->addErrorListener($parserErrorListener);

        // Obtener el árbol sintáctico
        $tree = $parser->program();

        // Recolectar errores léxicos y sintácticos
        $allErrors = array_merge(
            $lexerErrorListener->getErrors(),
            $parserErrorListener->getErrors()
        );

        // Crear e instanciar el visitor
        $visitor = new GolampiVisitor();

        // Visitar el árbol (ejecutar el programa)
        $visitor->visit($tree);

        // Obtener errores semánticos
        $semanticErrors = $visitor->getErrors();
        $allErrors = array_merge($allErrors, $semanticErrors);

        // Obtener resultados
        $result['output'] = $visitor->getOutputString();
        $result['errors'] = $allErrors;
        $result['symbolTable'] = $visitor->getSymbolTable();
        $result['success'] = empty($allErrors);
        $result['executionTime'] = microtime(true) - $startTime;

        if ($result['success']) {
            $result['message'] = "✅ Ejecución completada exitosamente";
        } else {
            $result['message'] = "⚠️  Ejecución completada con errores";
        }

    } catch (Exception $e) {
        $result['message'] = "❌ Error: " . $e->getMessage();
        $result['errors'][] = [
            'type' => 'Fatal',
            'description' => $e->getMessage(),
            'line' => 0,
            'column' => 0
        ];
        $result['executionTime'] = microtime(true) - $startTime;
    }

    return $result;
}

// ============================================================================
// MAIN EXECUTION
// ============================================================================

echo str_repeat("=", 100) . "\n";
echo "                    INTÉRPRETE GOLAMPI - SISTEMA DE PRUEBAS\n";
echo str_repeat("=", 100) . "\n";

// Determinar el archivo a ejecutar
$testFile = $argv[1] ?? __DIR__ . '/test1.golampi';

if (!file_exists($testFile)) {
    echo "❌ Error: El archivo '$testFile' no existe\n";
    echo "\nUso: php test.php [archivo.golampi]\n";
    exit(1);
}

// Ejecutar el archivo
$result = executeGolampiFile($testFile);

// Mostrar resultados
echo "\n" . str_repeat("=", 100) . "\n";
echo "RESULTADOS DE LA EJECUCIÓN\n";
echo str_repeat("=", 100) . "\n";
echo "Estado: " . $result['message'] . "\n";
echo "Tiempo de ejecución: " . number_format($result['executionTime'] * 1000, 2) . " ms\n";

// Mostrar salida del programa
if (!empty($result['output'])) {
    echo "\n" . str_repeat("-", 100) . "\n";
    echo "📤 SALIDA DEL PROGRAMA:\n";
    echo str_repeat("-", 100) . "\n";
    echo $result['output'] . "\n";
}

// Mostrar errores
if (!empty($result['errors'])) {
    echo formatErrorTable($result['errors']);
}

// Mostrar tabla de símbolos
if (!empty($result['symbolTable'])) {
    echo formatSymbolTable($result['symbolTable']);
}

// Resumen final
echo "\n" . str_repeat("=", 100) . "\n";
echo "RESUMEN\n";
echo str_repeat("=", 100) . "\n";
echo "Total de errores: " . count($result['errors']) . "\n";
echo "Total de símbolos: " . count($result['symbolTable']) . "\n";
echo "Estado final: " . ($result['success'] ? "✅ EXITOSO" : "❌ CON ERRORES") . "\n";
echo str_repeat("=", 100) . "\n";

exit($result['success'] ? 0 : 1);