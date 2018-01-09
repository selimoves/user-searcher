<?php

namespace App\Db\Filters;

use App\Db\Filters\AbstractFilter;
use App\Db\Field;
use App\Db\Filters\ItemFilter;

/**
 * Description of CountryFilter
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class CountryFilter
        extends AbstractFilter
{

    public function init()
    {
        $this->field = new Field('users_about.value', new ItemFilter('country'));
    }

}
