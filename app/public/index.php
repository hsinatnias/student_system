<?php
use Dotenv\Dotenv;
use Home\Solid\Container\Container;
use Home\Solid\Student\Contracts\ActivityServiceInterface;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Student\Services\ActivityService;
require '../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();
use Home\Solid\Student\Controllers\StudentController;

$container = new Container();

$container->bind(ActivityServiceInterface::class, ActivityService::class);
$container->bind(StudentRepositoryInterface::class, StudentRepository::class);

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = $uri === '' ? [] : explode('/', $uri);

$controllerName = ucfirst($segments[0] ?? 'home') . 'Controller';
$methodName = $segments[1] ?? 'index';

$controllerClass = 'Home\\Solid\\Student\\Controllers\\' . $controllerName;


if (class_exists($controllerClass)) {
    try {
        $controller = $container->make($controllerClass);

        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            echo "Method $methodName not found in controller $controllerClass.";
        }

    } catch (Exception $e) {
        http_response_code(500);
        echo "Container error: " . $e->getMessage();
    }

} else {
    http_response_code(404);
    echo "Page not found.";
}


// use  Home\Solid\Discounts\Discount;
// use Home\Solid\Discounts\SeniorDiscount;
// use Home\Solid\Discounts\StudentDiscount;
// use Home\Solid\Student\Controllers\StudentController;

// $studentDiscount = new Discount(new StudentDiscount);
// $seniorDiscount = new Discount(new SeniorDiscount);
// $student = new StudentController();

// echo $studentDiscount->calculate(250);
// echo "</br>";
// echo $seniorDiscount->calculate(250);

// $student->dashboard();


