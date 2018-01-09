<?php

namespace App\Service;

use Interop\Container\ContainerInterface;
use PDO;
use App\Service\UserService;

/**
 * Description of UserServiceFactory
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class UserServiceFactory
{

    /**
     * 
     * @param ContainerInterface $container
     * @return UserService
     */
    public function __invoke(ContainerInterface $container)
    {
        return new UserService($container->get(PDO::class));
    }

}
