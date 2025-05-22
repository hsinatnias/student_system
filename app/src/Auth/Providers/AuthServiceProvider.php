<?php

namespace Home\Solid\Auth\Providers;

use Home\Solid\Auth\Contracts\AuthRepositoryInterface;
use Home\Solid\Auth\Providers\ServiceProviderInterface;
use Home\Solid\Auth\Repositories\AuthRepository;
use Home\Solid\Container\Container;

class AuthServiceProvider implements ServiceProviderInterface{

    public static function register(Container $container): void{
        $container->bind(AuthRepositoryInterface::class, AuthRepository::class);

    }

}