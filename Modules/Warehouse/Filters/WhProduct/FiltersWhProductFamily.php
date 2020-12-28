<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductFamily Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isInt($value)) $value = -1; // invalid ID family
        
        return $query->selectRaw('wh_product.*')
                     ->join('wh_subfamily', 'wh_product.wh_subfamily_id', 'wh_subfamily.id')
                     ->where('wh_subfamily.wh_family_id', $value);
    } // end function
} // end class
