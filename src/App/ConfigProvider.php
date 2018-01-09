<?php

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{

    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'console' => $this->getConsoleCommands(),
            'db' => $this->getDb(),
            'db_filters' => $this->getDbFilters()
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'factories' => [
                // actions
                Action\HomeAction::class => Action\ActionFactory::class,
                Action\UsersAction::class => Action\ActionFactory::class,
                
                //services
                Service\UserService::class => Service\UserServiceFactory::class,
                
                //commands
                Command\GenerateDbDataCommand::class => Command\GenerateDbDataCommandFactory::class,
                
                //db
                \PDO::class => Db\PDOFactory::class,
                Db\Filters::class => Db\FiltersFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'app' => ['templates/app'],
                'error' => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }

    /**
     * Консольные команды
     * 
     * @return array
     */
    public function getConsoleCommands()
    {
        return [
            'commands' => [
                Command\GenerateDbDataCommand::class,
            ]
        ];
    }

    /**
     * Database settings
     * 
     * @return array
     */
    public function getDb()
    {
        return [
            'type' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'user_searcher',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ];
    }
    
    /**
     * 
     * @return array
     */
    public function getDbFilters()
    {
        return [
            'id' => Db\Filters\IdFilter::class,
            'email' => Db\Filters\EmailFilter::class,
            'country' => Db\Filters\CountryFilter::class,
            'name' => Db\Filters\NameFilter::class,
            'state' => Db\Filters\StateFilter::class,
        ];
    }

}
