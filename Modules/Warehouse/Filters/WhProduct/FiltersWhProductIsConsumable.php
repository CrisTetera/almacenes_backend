<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductIsConsumable Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isBool($value) && ! isArrayOfBoolean($value)) $value = ['false']; // invalid ID is_consumable
        if(! isArrayOfBoolean($value)) $value = [$value]; // pass single bool to array of single bool
        $value = array_unique($value); // delete duplicate of array
        $value = castStringArray_ToBoolArray($value); // Pass string  bool to bool
        return $query->whereIn('wh_product.is_consumable', $value);
    } // end function
} // end class