<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PDO;

/**
 * Description of CreateStaffCommand
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class GenerateDbDataCommand
        extends Command
{

    /**
     *
     * @var PDO 
     */
    private $pdo;

    /**
     * Constructor
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        parent::__construct();
    }

    /**
     * Configures the command
     */
    protected function configure()
    {
        $this->setName('generate-db-data')
                ->setDescription('Generate and load test data to database');
    }

    /**
     * Executes the current command
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     * 
     * @WARNING идентификатор для таблицы 'users' должен начинаться с "1"
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100000; $i++) {
            $sql = 'INSERT INTO users(email, password, role, reg_date, last_visit) VALUES('
                    . '"' . $faker->unique()->email . '",'
                    . '"' . $faker->md5 . '",'
                    . '"' . $this->getRole() . '",'
                    . '"' . date('Y-m-d H:i:s', $faker->unixTime) . '",'
                    . '"' . date('Y-m-d H:i:s', $faker->optional()->unixTime) . '"'
                    .')';
            
            $this->pdo->prepare($sql)->execute();
            
            $uid = $i + 1;
            $iv = $this->getItemAndValue($faker);
            $sql = 'INSERT INTO users_about(user, item, value) VALUES('
                    . '"' . $uid . '",'
                    . '"' . $iv['item'] . '",'
                    . '"' . $iv['value'] . '"'
                    .')';
            
            $this->pdo->prepare($sql)->execute();
        }

        $output->writeln('Done.');
    }
    
    /**
     * 
     * @param type $faker
     * @return array
     */
    protected function getItemAndValue($faker)
    {
        $enum = ['country','firstname','state'];
        $item = $enum[array_rand($enum)];
        
        $state = ['active', 'no active'];
        
        $ret = ['item' => $item];
        
        switch ($item) {
            case 'country':
                $ret['value'] = $faker->country;
                break;
            case 'firstname':
                $ret['value'] = $faker->firstName;
                break;
            default:
                $ret['value'] = $state[array_rand($state)];
                break;
        }
        
        return $ret;
    }
    
    /**
     * 
     * @return string
     */
    protected function getRole()
    {
        $roles = ['administrator','manager','editor','registered'];
        return $roles[array_rand($roles)];
    }

}
