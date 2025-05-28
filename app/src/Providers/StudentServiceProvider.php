<?php

namespace Home\Solid\Providers;

use Home\Solid\Database\Connection;
use Home\Solid\Container\Container;
use Home\Solid\Providers\ServiceProviderInterface;
use Home\Solid\Student\Contracts\StudentRepositoryInterface;
use Home\Solid\Student\Repositories\StudentRepository;
use Home\Solid\Student\Services\CreateStudentService;
use Home\Solid\Student\Services\DeleteStudentService;
use Home\Solid\Student\Services\UpdateStudentService;
use Home\Solid\Student\Services\UpdateStudentStatusService;
use PDO;

class StudentServiceProvider implements ServiceProviderInterface{

    public static function register(Container $container):void{
        $container->bind(CreateStudentService::class, CreateStudentService::class);
        $container->bind(UpdateStudentService::class, UpdateStudentService::class);
        $container->bind(DeleteStudentService::class, DeleteStudentService::class);
        $container->bind(UpdateStudentStatusService::class, UpdateStudentStatusService::class);
        $container->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }
}