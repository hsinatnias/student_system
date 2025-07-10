<?php

$container = require __DIR__ . '/../../app/bootstrap.php';

$routes = require __DIR__ . '/../../app/routes.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

header('Content-Type: application/json');

// Strip trailing slashes for uniformity
$uri = rtrim($uri, '/');

// Match route
if (array_key_exists($uri, $routes)) {
    $controllerClass = 'Home\\Solid\\' . $routes[$uri]['controller'];
    $methodName = $routes[$uri]['method'];

    if (class_exists($controllerClass)) {
        $controller = $container->make($controllerClass);
        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
            exit;
        }
    }

    http_response_code(404);
    echo json_encode(['error' => 'Method or controller not found.']);
    exit;
}

if (!str_starts_with($uri, '/api')) {
    require __DIR__ . '/../../public/index.html';
} else {
    http_response_code(404);
    echo json_encode(['error' => 'API route not found']);
}
