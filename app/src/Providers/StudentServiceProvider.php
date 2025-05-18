<?php

namespace Home\Solid\Providers;

use Home\Solid\Database\Connection;
use Home\Solid\Container\Container;
use Home\Solid\Providers\ServiceProviderInterface;
use Home\Solid\Student\Contracts\ActivityServiceInterface;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Student\Services\ActivityService;
use PDO;

class StudentServiceProvider implements ServiceProviderInterface{

    public static function register(Container $container):void{
        $container->bind(PDO::class, fn()=>Connection::getConnection());
        $container->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $container->bind(ActivityServiceInterface::class, ActivityService::class);
    }
}