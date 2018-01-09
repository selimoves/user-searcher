<?php

namespace App\Db;

use BadMethodCallException;
use App\Db\FilterChain;

/**
 * Description of Filters
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class Filters
{

    /** @var array */
    protected $filters;

    /**
     * 
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * 
     * @param array $chain
     * @return FilterChain
     */
    public function createFilterChain(array $chain)
    {
        return new FilterChain($chain);
    }

    /**
     * 
     * @param string $name
     * @param array $args
     * @return $this
     * @throws BadMethodCallException
     */
    public function __call($name, $args)
    {
        if (!array_key_exists($name, $this->filters)) {
            throw new BadMethodCallException('Unknown method: ' . $name . '()');
        }
        return (new $this->filters[$name]($args[0], !empty($args[1]) ? $args[1] : null));
    }

}
