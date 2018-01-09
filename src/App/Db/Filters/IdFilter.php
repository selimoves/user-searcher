<?php

namespace App\Db\Filters;

use App\Db\Filters\AbstractFilter;
use App\Db\Field;

/**
 * Description of IdFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class IdFilter
        extends AbstractFilter
{
    public function init()
    {
        $this->field = new Field('users.id');
    }
}
