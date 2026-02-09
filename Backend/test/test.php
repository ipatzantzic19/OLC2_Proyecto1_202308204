<?php

/**
 * Script de ejemplo para probar el intérprete de Golampi
 * Este archivo muestra cómo usar el visitor una vez generado el parser
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Después de generar el parser con ANTLR, descomenta:
// require_once __DIR__ . '/../generated/GolampiLexer.php';
// require_once __DIR__ . '/../generated/GolampiParser.php';

use Golampi\Visitor\GolampiVisitor;
use Golampi\Runtime\Value;

// Ejemplo de código Golampi a interpretar
$sourceCode = <<<'GOLAMPI'
func main() {
    var x int32 = 10
    var y int32 = 20
    var result int32 = x + y
    fmt.Println("Resultado:", result)
}
GOLAMPI;

try {
    // Paso 1: Crear el lexer (descomenta después de generar)
    // $input = InputStream::fromString($sourceCode);
    // $lexer = new GolampiLexer($input);
    
    // Paso 2: Crear el parser
    // $tokens = new CommonTokenStream($lexer);
    // $parser = new GolampiParser($tokens);
    
    // Paso 3: Obtener el árbol sintáctico
    // $tree = $parser->program();
    
    // Paso 4: Crear y ejecutar el visitor
    // $visitor = new GolampiVisitor();
    // $result = $visitor->visit($tree);
    
    // Paso 5: Obtener resultados
    // $output = $visitor->getOutputString();
    // $errors = $visitor->getErrors();
    // $symbolTable = $visitor->getSymbolTable();
    
    echo "Este es un ejemplo de cómo usar el intérprete.\n";
    echo "Primero debes generar el parser con ANTLR:\n";
    echo "java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
