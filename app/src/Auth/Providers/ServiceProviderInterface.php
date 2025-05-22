<?php

namespace Home\Solid\Auth\Providers;

use Home\Solid\Container\Container;

interface ServiceProviderInterface{
    public static function register(Container $container): void;
}