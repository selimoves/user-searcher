<?php

namespace App\Service;

use PDO;
use App\Db\FilterChain;

/**
 * Description of UserService
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class UserService
{

    /** @var PDO */
    protected $pdo;

    /**
     * Constructor
     * 
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Поиск по заданным условиям
     * 
     * @param FilterChain $chain
     * @param array $params
     * @param int $limitFrom
     * @param int $limitCount
     * @return array
     */
    public function getUsers(FilterChain $chain, array $params, int $limitFrom = null, int $limitCount = null)
    {
        $where = '';
        if ($sql = $chain->getWhereSQL()) {
            $where = ' WHERE ' . $chain->getWhereSQL();
        }

        $limit = '';
        if (($limitFrom !== null) && ($limitCount === null)) {
            $limit = ' LIMIT ' . $limitFrom;
        } else if (($limitFrom !== null) && ($limitCount !== null)) {
            $limit = ' LIMIT ' . $limitFrom . ', ' . $limitCount;
        }

        $stmt = $this->pdo->prepare('SELECT users.id, users.email, users.role, users.reg_date '
                . 'FROM users '
                . 'JOIN users_about ON users.id = users_about.user '
                . $where . $limit);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

}
