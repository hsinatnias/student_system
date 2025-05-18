<?php

use Dotenv\Dotenv;
use Home\Solid\Container\Container;
use Home\Solid\Providers\StudentServiceProvider;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
StudentServiceProvider::register($container);

return $container;
