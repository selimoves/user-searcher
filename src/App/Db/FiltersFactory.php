<?php

namespace App\Db;

use Interop\Container\ContainerInterface;
use App\Db\Filters;

/**
 * Description of FiltersFactory
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class FiltersFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        return new Filters($config['db_filters']);
    }
}
