<?php

namespace Modules\Warehouse\Filters\FiltersWhProductMovementReport;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductMovementReportProducts Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value); // delete duplicate of array

        return $query->whereIn('wh_product_movement_report.wh_product_id', $value);
    } // end function
} // end class
