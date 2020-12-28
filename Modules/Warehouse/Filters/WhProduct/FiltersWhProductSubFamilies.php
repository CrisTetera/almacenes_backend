<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductSubFamilies Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! is_array($value)) $value = [$value];
        return $query->whereIn('wh_product.wh_subfamily_id', $value);
    } // end function
} // end class
