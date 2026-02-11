<?php

/**
 * API REST Entry Point
 * Golampi IDE Backend
 */

require_once __DIR__ . '/vendor/autoload.php';

use Golampi\Api\ApiRouter;

// CORS Headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Get request data
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Ensure path starts with /api
if (strpos($path, '/api/') !== 0) {
    $path = '/api' . $path;
}

// Get body
$input = file_get_contents('php://input');
$body = json_decode($input, true) ?? [];

// Route request
try {
    $router = new ApiRouter();
    $router->handle($method, $path, $body);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}