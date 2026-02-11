<?php

namespace Golampi\Api;

/**
 * Router API REST para Golampi IDE
 * Endpoints:
 * - POST /api/execute -> Ejecuta código y retorna todo
 * - POST /api/errors -> Retorna solo errores
 * - POST /api/symbols -> Retorna solo tabla de símbolos
 */
class ApiRouter
{
    private array $routes = [];
    private ExecutionHandler $executionHandler;

    public function __construct()
    {
        $this->executionHandler = new ExecutionHandler();
        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        // Endpoint principal - ejecuta código completo
        $this->routes['POST']['/api/execute'] = [$this, 'handleExecute'];
        
        // Endpoint de errores
        $this->routes['POST']['/api/errors'] = [$this, 'handleErrors'];
        
        // Endpoint de símbolos
        $this->routes['POST']['/api/symbols'] = [$this, 'handleSymbols'];
    }

    public function handle(string $method, string $path, array $body = []): void
    {
        // CORS Headers
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        if (isset($this->routes[$method][$path])) {
            try {
                $response = call_user_func($this->routes[$method][$path], $body);
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        } else {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'error' => 'Endpoint not found'
            ]);
        }
    }

    /**
     * POST /api/execute
     * Ejecuta código Golampi y retorna salida completa
     */
    private function handleExecute(array $body): array
    {
        if (!isset($body['code']) || empty(trim($body['code']))) {
            return [
                'success' => false,
                'error' => 'Code cannot be empty',
                'output' => [],
                'errors' => [],
                'symbolTable' => []
            ];
        }

        return $this->executionHandler->execute($body['code']);
    }

    /**
     * POST /api/errors
     * Retorna solo los errores del análisis
     */
    private function handleErrors(array $body): array
    {
        if (!isset($body['code'])) {
            return ['success' => false, 'error' => 'Code required'];
        }

        $result = $this->executionHandler->execute($body['code']);
        
        return [
            'success' => count($result['errors']) === 0,
            'errors' => $result['errors'],
            'errorCount' => count($result['errors'])
        ];
    }

    /**
     * POST /api/symbols
     * Retorna solo la tabla de símbolos
     */
    private function handleSymbols(array $body): array
    {
        if (!isset($body['code'])) {
            return ['success' => false, 'error' => 'Code required'];
        }

        $result = $this->executionHandler->execute($body['code']);
        
        return [
            'success' => $result['success'],
            'symbolTable' => $result['symbolTable'],
            'symbolCount' => count($result['symbolTable'])
        ];
    }
}