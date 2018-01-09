<?php

namespace App\Command;

use Interop\Container\ContainerInterface;
use PDO;

/**
 * Description of CreateStaffCommandFactory
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class GenerateDbDataCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new GenerateDbDataCommand($container->get(PDO::class));
    }
}
