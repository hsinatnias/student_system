<?php

namespace Home\Solid\Providers;

use Home\Solid\Container\Container;

Interface ServiceProviderInterface{
    public static function register(Container $container): void;
}