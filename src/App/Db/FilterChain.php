<?php

namespace App\Db;

/**
 * Description of FilterChain
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class FilterChain
{

    /** @var array */
    protected $chain;

    /**
     * 
     * @param array $chain
     */
    public function __construct(array $chain)
    {
        $this->chain = $chain;
    }

    /**
     * 
     * @param mixed $chain
     * @return string
     */
    public function getWhereSQL($chain = null)
    {
        $result = '';

        if (null == $chain) {
            $chain = $this->chain;
        }

        if (is_array($chain)) {
            foreach ($chain as $var => $value) {
                if (!is_numeric($var)) {
                    if (is_array($value)) {
                        $result .= ' ' . $var . ' (' . $this->getWhereSQL($value) . ')';
                    } else {
                        $result .= ' ' . $var . ' ' . $this->getWhereSQL($value);
                    }
                } else {
                    $result .= $value;
                }
            }
        } else {
            $result .= $chain;
        }

        return $result;
    }

}
