<?php
namespace Home\Solid\Container;

use ReflectionClass;
use ReflectionParameter;
use Closure;
use Exception;

class Container {
    protected array $bindings = [];

    public function bind(string $abstract, mixed $concrete): void {
        $this->bindings[$abstract] = $concrete;
    }

    public function make(string $abstract): mixed {
        // If bound
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];

            // If it's a Closure (factory)
            if ($concrete instanceof Closure) {
                return $concrete($this);
            }

            // If it's a class name, continue
            $abstract = $concrete;
        }

        // Handle automatic dependency resolution
        $reflector = new ReflectionClass($abstract);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class [$abstract] is not instantiable");
        }

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $abstract;
        }

        $dependencies = array_map(
            fn(ReflectionParameter $param) => $this->make($param->getType()->getName()),
            $constructor->getParameters()
        );

        return $reflector->newInstanceArgs($dependencies);
    }
}
