<?php

namespace Modules\Warehouse\Filters\WhProductPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductFamily Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isInt($value)) $value = -1; // invalid ID family
        
        return $query->selectRaw('wh_product_pos.*')
                     ->join('wh_subfamily_pos', 'wh_product_pos.wh_subfamily_id', 'wh_subfamily_pos.id')
                     ->where('wh_subfamily_pos.wh_family_id', $value);
    } // end function
} // end class
