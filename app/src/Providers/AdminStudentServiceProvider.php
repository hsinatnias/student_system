<?php

namespace Home\Solid\Providers;

use Home\Solid\Database\Connection;
use Home\Solid\Container\Container;
use Home\Solid\Providers\ServiceProviderInterface;
use Home\Solid\Admin\Contracts\RepositoryInterface;
use Home\Solid\Admin\Repositories\StudentRepository;
use Home\Solid\Admin\Services\Student\CreateStudentService;
use Home\Solid\Admin\Services\Student\DeleteStudentService;
use Home\Solid\Admin\Services\Student\UpdateStudentService;
use Home\Solid\Admin\Services\Student\UpdateStudentStatusService;
use PDO;

class AdminStudentServiceProvider implements ServiceProviderInterface{

    public static function register(Container $container):void{
        $container->bind(CreateStudentService::class, CreateStudentService::class);
        $container->bind(UpdateStudentService::class, UpdateStudentService::class);
        $container->bind(DeleteStudentService::class, DeleteStudentService::class);
        $container->bind(UpdateStudentStatusService::class, UpdateStudentStatusService::class);
        $container->bind(RepositoryInterface::class, StudentRepository::class);
    }
}