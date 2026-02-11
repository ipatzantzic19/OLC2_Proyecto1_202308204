<?php

/**
 * API REST para el intérprete Golampi
 * Punto de entrada principal
 */

// Cargar autoloader de Composer
require_once __DIR__ . '/vendor/autoload.php';

// Importar clases necesarias
use Golampi\Api\ApiRouter;

// Habilitar CORS y JSON
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Manejar preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Obtener método y ruta
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// La ruta debe ser /api/* para que ApiRouter la maneje
// Si no empieza con /api, agrégalo
if (strpos($path, '/api/') !== 0) {
    $path = '/api' . $path;
}

// Obtener el body (JSON)
$input = file_get_contents('php://input');
$body = json_decode($input, true) ?? [];

// Crear router y manejar la petición
try {
    $router = new ApiRouter();
    $router->handle($method, $path, $body);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
    ]);
}
