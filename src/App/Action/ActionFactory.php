<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use ReflectionClass;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of ActionFactory
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class ActionFactory
        implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $reflection = new ReflectionClass($requestedName);
        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            return new $requestedName;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $class = $parameter->getClass();
            $dependencies[] = $container->get($class->getName());
        }
        return $reflection->newInstanceArgs($dependencies);
    }

}
