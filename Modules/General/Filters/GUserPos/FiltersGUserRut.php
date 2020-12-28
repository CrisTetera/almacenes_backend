<?php

namespace Modules\General\Filters\GUserPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersGUserRut Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        $value = strtolower($value);
        if(! isJoined($query, 'hr_employee_pos')) { 
            $query->join('hr_employee_pos', 'g_user_pos.hr_employee_id', 'hr_employee_pos.id');
            $query->select('g_user.*');
        }
        
        return $query->where('hr_employee_pos.rut', $value);
    }
}
