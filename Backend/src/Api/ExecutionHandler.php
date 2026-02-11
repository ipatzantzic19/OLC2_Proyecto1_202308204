<?php

namespace Golampi\Api;

use Golampi\Visitor\GolampiVisitor;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenFactory;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use GolampiLexer;
use GolampiParser;

/**
 * Handler para ejecutar código Golampi
 */
class ExecutionHandler
{
    private GolampiVisitor $visitor;

    public function __construct()
    {
        $this->visitor = new GolampiVisitor();
    }

    /**
     * Ejecuta código Golampi
     * @param string $code Código a ejecutar
     * @return array Resultado de la ejecución
     */
    public function execute(string $code): array
    {
        try {
            // Crear stream de entrada
            $input = InputStream::fromString($code);

            // Crear lexer
            $lexer = new GolampiLexer($input);
            $lexer->removeErrorListeners();
            $lexer->addErrorListener(new \Antlr\Antlr4\Runtime\Error\ErrorListener\DiagnosticErrorListener());

            // Crear token stream
            $tokenStream = new CommonTokenStream($lexer);

            // Crear parser
            $parser = new GolampiParser($tokenStream);
            $parser->removeErrorListeners();
            $parser->addErrorListener(new \Antlr\Antlr4\Runtime\Error\ErrorListener\DiagnosticErrorListener());

            // Obtener árbol de análisis
            $tree = $parser->program();

            // Ejecutar el programa
            $this->visitor->visit($tree);

            // Recopilar resultados
            $output = $this->visitor->getOutput();
            $errors = $this->visitor->getErrors();
            $symbolTable = $this->visitor->getSymbols();

            return [
                'success' => count($errors) === 0,
                'output' => $output,
                'errors' => $errors,
                'symbolTable' => $symbolTable,
                'timestamp' => date('Y-m-d H:i:s'),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'output' => [],
                'errors' => [
                    [
                        'type' => 'RUNTIME_ERROR',
                        'message' => $e->getMessage(),
                        'line' => 0,
                        'column' => 0,
                    ]
                ],
                'symbolTable' => [],
                'timestamp' => date('Y-m-d H:i:s'),
            ];
        }
    }

    /**
     * Valida la sintaxis del código
     * @param string $code Código a validar
     * @return array Resultado de validación
     */
    public function validate(string $code): array
    {
        try {
            $input = InputStream::fromString($code);
            $lexer = new GolampiLexer($input);
            $lexer->removeErrorListeners();

            $tokenStream = new CommonTokenStream($lexer);
            $parser = new GolampiParser($tokenStream);
            $parser->removeErrorListeners();

            $tree = $parser->program();

            $errors = $this->visitor->getErrors();

            return [
                'success' => count($errors) === 0,
                'errors' => $errors,
                'message' => count($errors) === 0 ? 'Sintaxis válida' : 'Errores encontrados',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => [
                    [
                        'type' => 'SYNTAX_ERROR',
                        'message' => $e->getMessage(),
                        'line' => 0,
                        'column' => 0,
                    ]
                ],
                'message' => 'Error de sintaxis',
            ];
        }
    }
}
