<?php

namespace Golampi\Api;

/**
 * Router para las rutas de la API
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

    /**
     * Registra todas las rutas disponibles
     */
    private function registerRoutes(): void
    {
        // POST /api/execute
        $this->routes['POST']['/api/execute'] = [$this, 'handleExecute'];

        // POST /api/validate
        $this->routes['POST']['/api/validate'] = [$this, 'handleValidate'];

        // POST /api/symbol-table
        $this->routes['POST']['/api/symbol-table'] = [$this, 'handleSymbolTable'];

        // GET /api/examples
        $this->routes['GET']['/api/examples'] = [$this, 'handleExamples'];

        // GET /api/language-info
        $this->routes['GET']['/api/language-info'] = [$this, 'handleLanguageInfo'];
    }

    /**
     * Maneja peticiones HTTP
     * @param string $method Método HTTP
     * @param string $path Ruta solicitada
     * @param array $body Body de la petición
     */
    public function handle(string $method, string $path, array $body = []): void
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            return;
        }

        if (isset($this->routes[$method][$path])) {
            // Para GET, no pasar body
            if ($method === 'GET') {
                $response = call_user_func($this->routes[$method][$path]);
            } else {
                // Para POST, pasar body
                $response = call_user_func($this->routes[$method][$path], $body);
            }
            echo json_encode($response);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Endpoint no encontrado']);
        }
    }

    /**
     * Maneja POST /api/execute
     */
    private function handleExecute(array $body): array
    {
        if (!isset($body['code'])) {
            return ['success' => false, 'error' => 'Se requiere el código'];
        }

        return $this->executionHandler->execute($body['code']);
    }

    /**
     * Maneja POST /api/validate
     */
    private function handleValidate(array $body): array
    {
        if (!isset($body['code'])) {
            return ['success' => false, 'error' => 'Se requiere el código'];
        }

        return $this->executionHandler->validate($body['code']);
    }

    /**
     * Maneja POST /api/symbol-table
     */
    private function handleSymbolTable(array $body): array
    {
        if (!isset($body['code'])) {
            return ['success' => false, 'error' => 'Se requiere el código'];
        }

        $result = $this->executionHandler->execute($body['code']);
        return [
            'success' => $result['success'],
            'symbols' => $result['symbolTable'],
            'errors' => $result['errors'],
        ];
    }

    /**
     * Maneja GET /api/examples
     */
    private function handleExamples(): array
    {
        return [
            'success' => true,
            'examples' => [
                [
                    'name' => 'Hola Mundo',
                    'description' => 'Programa simple que imprime un mensaje',
                    'code' => 'package main

Func main() {
    var message string = "¡Hola Mundo!";
    println(message);
}',
                ],
                [
                    'name' => 'Bucle For',
                    'description' => 'Ejemplo de bucle for',
                    'code' => 'package main

Func main() {
    for i := 0; i < 5; i++ {
        println("Número:", i);
    }
}',
                ],
                [
                    'name' => 'Condicionales',
                    'description' => 'Ejemplo de if-else',
                    'code' => 'package main

Func main() {
    var age int32 = 20;
    
    if age >= 18 {
        println("Eres mayor de edad");
    } else {
        println("Eres menor de edad");
    }
}',
                ],
                [
                    'name' => 'Funciones',
                    'description' => 'Definición de funciones',
                    'code' => 'package main

Func main() {
    var result int32 = sum(5, 3);
    println("Suma:", result);
}

Func sum(a int32, b int32) int32 {
    return a + b;
}',
                ],
            ],
        ];
    }

    /**
     * Maneja GET /api/language-info
     */
    private function handleLanguageInfo(): array
    {
        return [
            'success' => true,
            'info' => [
                'name' => 'Golampi',
                'version' => '1.0.0',
                'description' => 'Un lenguaje de programación educativo',
                'author' => 'OLC2 - Universidad San Carlos de Guatemala',
                'features' => [
                    'Variables tipadas',
                    'Funciones',
                    'Control de flujo (if, for, switch)',
                    'Arreglos',
                    'Punteros',
                    'Comentarios',
                ],
                'types' => [
                    'int32',
                    'float32',
                    'bool',
                    'rune',
                    'string',
                ],
            ],
        ];
    }
}
