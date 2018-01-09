<?php

namespace App\Db\Filters;

use RuntimeException;
use App\Db\Field;

/**
 * Description of AbstractFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
abstract class AbstractFilter
{

    const EQ = '=';
    const NE = '<>';
    const GT = '>';
    const LT = '<';

    /** @var array */
    protected $ops = [self::EQ, self::GT, self::LT, self::NE];

    /** @var string */
    protected $op;

    /** @var string */
    protected $val;

    /** @var Field */
    protected $field;

    /**
     * 
     * @param string $var1
     * @param string $var2
     */
    public function __construct($var1, $var2 = null)
    {
        if (null == $var2) {
            $this->op = self::EQ;
            $this->val = $var1;
        } else {
            if (!in_array($var1, $this->ops)) {
                throw new RuntimeException('Unknown type of comparison');
            }
            $this->op = $var1;
            $this->val = $var2;
        }

        $this->init();
    }

    abstract public function init();

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        $val = $this->valIsParam() ? $this->getVal() : '"' . $this->getVal() . '"';
        
        if ($this->getField()->hasFilter()) {
            return '(' . $this->getField()->getFilter() . ' AND (' . $this->getField() . ' ' . $this->getOp() . ' ' . $val . '))';
        }
        
        return '(' . $this->getField() . ' ' . $this->getOp() . ' ' . $val . ')';
    }

    /**
     * 
     * @return Field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * 
     * @return string
     */
    public function getVal()
    {
        return $this->val;
    }

    /**
     * 
     * @return string
     */
    public function getOp()
    {
        return $this->op;
    }

    /**
     * 
     * @return boolean
     */
    public function valIsParam()
    {
        if (preg_match('/^:.+$/', $this->val)) {
            return true;
        }
        return false;
    }

}
