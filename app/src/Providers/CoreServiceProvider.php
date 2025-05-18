<?php
namespace Home\Solid\Providers;

use Home\Solid\Container\Container;
use PDO;
use Home\Solid\Database\Connection;

class CoreServiceProvider implements ServiceProviderInterface{

    public static function register(Container $container):void{
        $container->bind(PDO::class, fn()=> Connection::getConnection());
    }
}