<?php

namespace App\Db;

use InvalidArgumentException;
use App\Db\Filters\AbstractFilter;

/**
 * Description of Field
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class Field
{
    /** @var string */
    protected $table;

    /** @var string */
    protected $fieldName;
    
    /** @var AbstractFilter */
    protected $filter;
    
    /**
     * 
     * @param string $field
     * @param AbstractFilter $filter
     * @throws InvalidArgumentException
     */
    public function __construct(string $field, AbstractFilter $filter = null)
    {
        if (preg_match('/^(\w+?)\.(\w+?)$/', $field, $matches)) {
            $this->table = $matches[1];
            $this->fieldName = $matches[2];
        } else {
            throw new InvalidArgumentException('Incorrect param');
        }
        
        if (null !== $filter) {
            $this->filter = $filter;
        }
    }
    
    /**
     * 
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasFilter()
    {
        return (null !== $this->filter);
    }
    
    /**
     * 
     * @return AbstractFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getTable() . '.' . $this->fieldName;
    }
}
