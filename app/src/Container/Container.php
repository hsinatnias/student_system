<?php
namespace Home\Solid\Container;

use ReflectionClass;
use ReflectionParameter;
use Exception;

class Container{
    protected array $bindings = [];

    public function bind(string $abstract, string $concrete): void{
        $this->bindings[$abstract] = $concrete;
    }

    public function make(string $class){
        if(isset($this->bindings[$class])){
            $class = $this->bindings[$class];
        }
        $reflector = new ReflectionClass($class);

        if(!$reflector->isInstantiable()){
            throw new Exception("Class [$class] is not instantiable");
        }

        $constructor =  $reflector->getConstructor();

        if(!$constructor){
            return new $class;
        }

        $dependencies = array_map(
            fn(ReflectionParameter $param) => $this->make($param->getType()->getName()),
            $constructor->getParameters()
        );

        return $reflector->newInstanceArgs($dependencies);
    }
}