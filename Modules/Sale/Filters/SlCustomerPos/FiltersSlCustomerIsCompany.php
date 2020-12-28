<?php

namespace Modules\Sale\Filters\SlCustomerPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlCustomerIsCompany Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if($value > 1 || $value < 0) $value = 0;
        $value = boolval($value);
        if(! isBool($value) && ! isArrayOfBoolean($value)) $value = ['false']; // invalid ID is_company
        if(! isArrayOfBoolean($value)) $value = [$value]; // pass single bool to array of single bool
        $value = array_unique($value); // delete duplicate of array
        $value = castStringArray_ToBoolArray($value); // Pass string  bool to bool
        return $query->whereIn('sl_customer_pos.is_company', $value);
        
    }
}
