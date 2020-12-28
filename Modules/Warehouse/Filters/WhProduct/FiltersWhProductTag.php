<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductTag Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value); // delete duplicate of array
        
        return $query->selectRaw('wh_product.*')
                     ->join('wh_tag_wh_product', 'wh_product.id', 'wh_tag_wh_product.wh_product_id')
                     ->whereIn('wh_tag_wh_product.wh_tag_id', $value)
                     ->groupBy('wh_product.id')
                     ->having(\DB::raw('count(*)'), '=', count($value));
    }
}
