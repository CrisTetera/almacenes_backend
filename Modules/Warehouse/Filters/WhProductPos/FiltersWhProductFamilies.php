<?php

namespace Modules\Warehouse\Filters\WhProductPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductFamilies Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        
        if(! isJoined($query, 'hr_employee_pos')) { 
            $query->selectRaw('wh_product_pos.*')
                  ->join('wh_subfamily_pos', 'wh_product_pos.wh_subfamily_id', 'wh_subfamily_pos.id');
        }

        if(! is_array($value)) $value = [$value];
        return $query->whereIn('wh_subfamily_pos.wh_family_id', $value);
    } // end function
} // end class
