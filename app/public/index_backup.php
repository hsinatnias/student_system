<?php

use Dotenv\Dotenv;
use Home\Solid\Container\Container;
use Home\Solid\Providers\StudentServiceProvider;


require '../../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();


$container = new Container();


StudentServiceProvider::register($container);


$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = $uri === '' ? [] : explode('/', $uri);


$module = ucfirst($segments[0] ?? 'student');
$controllerName = ucfirst($segments[1] ?? 'home') . 'Controller';
$methodName = $segments[2] ?? 'index';

$controllerClass = "Home\\Solid\\{$module}\\Controllers\\{$controllerName}";



if (class_exists($controllerClass)) {
    try {
        
        $controller = $container->make($controllerClass);

        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            http_response_code(404);
            echo "Method <strong>$methodName</strong> not found in controller <strong>$controllerClass</strong>.";
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo "Container error: " . $e->getMessage();
    }
} else {
    http_response_code(404);
    echo "Page not found: Controller <strong>$controllerClass</strong> does not exist.";
}
