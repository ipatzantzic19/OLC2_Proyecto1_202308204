<?php

namespace Golampi\Api;

use Golampi\Visitor\GolampiVisitor;
use Golampi\Runtime\Value;
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;

require_once __DIR__ . '/../../generated/GolampiLexer.php';
require_once __DIR__ . '/../../generated/GolampiParser.php';

/**
 * Error Listener personalizado
 */
class CustomErrorListener extends BaseErrorListener
{
    private array $errors = [];

    public function syntaxError(
        \Antlr\Antlr4\Runtime\Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?\Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException $exception
    ): void {
        $this->errors[] = [
            'type' => 'Sintáctico',
            'description' => $msg,
            'line' => $line,
            'column' => $charPositionInLine
        ];
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

/**
 * Handler de ejecución de código Golampi
 */
class ExecutionHandler
{
    private array $lastErrors = [];
    private array $lastSymbols = [];

    public function getLastErrors(): array
    {
        return $this->lastErrors;
    }

    public function getLastSymbols(): array
    {
        return $this->lastSymbols;
    }

    public function execute(string $code): array
    {
        $startTime = microtime(true);
        
        try {
            // Parse del código
            $input = InputStream::fromString($code);
            
            // Lexer
            $lexer = new \GolampiLexer($input);
            $lexerErrors = new CustomErrorListener();
            $lexer->removeErrorListeners();
            $lexer->addErrorListener($lexerErrors);
            
            // Parser
            $tokens = new CommonTokenStream($lexer);
            $parser = new \GolampiParser($tokens);
            $parserErrors = new CustomErrorListener();
            $parser->removeErrorListeners();
            $parser->addErrorListener($parserErrors);
            
            // AST
            $tree = $parser->program();
            
            // Errores sintácticos
            $allErrors = array_merge(
                $lexerErrors->getErrors(),
                $parserErrors->getErrors()
            );
            
            // Visitor
            $visitor = new GolampiVisitor();
            
            try {
                $visitor->visit($tree);
            } catch (\Exception $e) {
                $allErrors[] = [
                    'type' => 'Runtime',
                    'description' => $e->getMessage(),
                    'line' => 0,
                    'column' => 0
                ];
            }
            
            // Errores semánticos
            $allErrors = array_merge($allErrors, $visitor->getErrors());
            
            // Formatear resultados
            $output = $visitor->getOutput();
            $symbols = $this->formatSymbols($visitor->getSymbolTable());
            $errors = $this->formatErrors($allErrors);

            // Save last results for later retrieval
            $this->lastErrors = $errors;
            $this->lastSymbols = $symbols;

            // Persist last results to temp files so they survive across requests
            $tmp = sys_get_temp_dir();
            @file_put_contents($tmp . '/golampi_last_errors.json', json_encode($errors, JSON_UNESCAPED_UNICODE));
            @file_put_contents($tmp . '/golampi_last_symbols.json', json_encode($symbols, JSON_UNESCAPED_UNICODE));
            
            $executionTime = round((microtime(true) - $startTime) * 1000, 2);
            
            return [
                'success' => count($errors) === 0,
                'output' => $output,
                'errors' => $errors,
                'symbolTable' => $symbols,
                'executionTime' => $executionTime . 'ms',
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'output' => [],
                'errors' => [[
                    'type' => 'Fatal',
                    'description' => $e->getMessage(),
                    'line' => 0,
                    'column' => 0
                ]],
                'symbolTable' => [],
                'executionTime' => '0ms',
                'timestamp' => date('Y-m-d H:i:s')
            ];
        }
    }
    
    private function formatErrors(array $errors): array
    {
        return array_map(function($error, $index) {
            return [
                'id' => $index + 1,
                'type' => $error['type'] ?? 'Unknown',
                'description' => $error['description'] ?? '',
                'line' => $error['line'] ?? 0,
                'column' => $error['column'] ?? 0
            ];
        }, $errors, array_keys($errors));
    }
    
    private function formatSymbols(array $symbols): array
    {
        return array_map(function($symbol) {
            $value = $symbol['value'];
            if ($value instanceof Value) {
                $valueStr = $value->toString();
            } else {
                $valueStr = $value === null ? 'nil' : (string)$value;
            }
            
            return [
                'identifier' => $symbol['identifier'] ?? '',
                'type' => $symbol['type'] ?? '',
                'scope' => $symbol['scope'] ?? 'global',
                'value' => $valueStr,
                'line' => $symbol['line'] ?? 0,
                'column' => $symbol['column'] ?? 0
            ];
        }, $symbols);
    }
}