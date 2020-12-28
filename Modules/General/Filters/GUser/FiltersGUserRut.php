<?php

namespace Modules\General\Filters\GUser;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersGUserRut Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        $value = strtolower($value);
        if(! isJoined($query, 'hr_employee')) { 
            $query->join('hr_employee', 'g_user.hr_employee_id', 'hr_employee.id');
            $query->select('g_user.*');
        }
        
        return $query->where('hr_employee.rut', $value);
    }
}
