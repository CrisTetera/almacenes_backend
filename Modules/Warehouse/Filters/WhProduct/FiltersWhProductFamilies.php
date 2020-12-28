<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductFamilies Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        
        if(! isJoined($query, 'hr_employee')) { 
            $query->selectRaw('wh_product.*')
                  ->join('wh_subfamily', 'wh_product.wh_subfamily_id', 'wh_subfamily.id');
        }

        if(! is_array($value)) $value = [$value];
        return $query->whereIn('wh_subfamily.wh_family_id', $value);
    } // end function
} // end class
