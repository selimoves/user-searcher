<?php

namespace App\Db\Filters;

use App\Db\Filters\AbstractFilter;
use App\Db\Field;

/**
 * Description of ItemFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class ItemFilter
        extends AbstractFilter
{
    public function init()
    {
        $this->field = new Field('users_about.item');
    }
}
