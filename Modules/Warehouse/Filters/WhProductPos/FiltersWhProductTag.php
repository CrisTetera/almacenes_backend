<?php

namespace Modules\Warehouse\Filters\WhProductPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductTag Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value); // delete duplicate of array
        
        return $query->selectRaw('wh_product_pos.*')
                     ->join('wh_tag_wh_product_pos', 'wh_product_pos.id', 'wh_tag_wh_product_pos.wh_product_id')
                     ->whereIn('wh_tag_wh_product_pos.wh_tag_id', $value)
                     ->groupBy('wh_product_pos.id')
                     ->having(\DB::raw('count(*)'), '=', count($value));
    }
}
