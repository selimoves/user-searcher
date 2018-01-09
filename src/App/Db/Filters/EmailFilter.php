<?php

namespace App\Db\Filters;

use App\Db\Filters\AbstractFilter;
use App\Db\Field;

/**
 * Description of EmailFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class EmailFilter
        extends AbstractFilter
{
    public function init()
    {
        $this->field = new Field('users.email');
    }
}
