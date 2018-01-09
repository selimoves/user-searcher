<?php

namespace App\Db;

use PDO;
use Interop\Container\ContainerInterface;

/**
 * Description of PDOFactory
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class PDOFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $dbConf = $config['db'];

        if ($dbConf['type'] == 'sqlite') {
            return new PDO("sqlite:" . $dbConf['dbfile']);
            
        } else {
            $dsn = $dbConf['type']
                    . ':host=' . $dbConf['host']
                    . ';dbname=' . $dbConf['dbname']
                    . ';charset=' . $dbConf['charset'];

            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            return new PDO($dsn, $dbConf['username'], $dbConf['password'], $opt);
        }
    }

}
