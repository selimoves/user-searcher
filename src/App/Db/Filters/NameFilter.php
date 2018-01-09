<?php

namespace App\Db\Filters;

use App\Db\Filters\AbstractFilter;
use App\Db\Field;
use App\Db\Filters\ItemFilter;

/**
 * Description of NameFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class NameFilter
        extends AbstractFilter
{

    public function init()
    {
        $this->field = new Field('users_about.value', new ItemFilter('firstname'));
    }

}
