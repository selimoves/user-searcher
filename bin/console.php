<?php

set_time_limit(0);

use Symfony\Component\Console\Application;

chdir(__DIR__ . '/../');

require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';
$application = new Application('Application console');

$commands = $container->get('config')['console']['commands'];
foreach ($commands as $command) {
    $application->add($container->get($command));
}

$application->run();
