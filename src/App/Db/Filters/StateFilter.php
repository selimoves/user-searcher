<?php

namespace App\Db\Filters;

use App\Db\Filters\AbstractFilter;
use App\Db\Field;
use App\Db\Filters\ItemFilter;

/**
 * Description of StateFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class StateFilter
        extends AbstractFilter
{

    public function init()
    {
        $this->field = new Field('users_about.value', new ItemFilter('state'));
    }

}
