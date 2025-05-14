<?php
require '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();
use Home\Solid\Student\Controllers\StudentController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/'); // Remove leading/trailing slashes
$uri = $uri === '' ? [] : explode('/', $uri); // Convert to empty array if no segments

$controllerName = $uri[0] ?? 'home'; // Use first segment or default to 'home'

$methodName = $uri[1] ?? 'index';   
$controllerName = ucfirst($controllerName) . 'Controller';


$controllerClass = 'Home\\Solid\\Student\\Controllers\\' . ucfirst($controllerName) ;

    if (class_exists($controllerClass)) {
        $student = new $controllerClass();
        if (method_exists($student, $methodName)) {
            $student->$methodName();
        } else {
            echo "Method $methodName not found in controller $controllerClass.";

            error_log("Method $methodName not found in controller $controllerClass.");
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


