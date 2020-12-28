<?php

namespace Modules\Sale\Filters\SlOfferPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferUpcCode Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value);
        // return $query->where(function (Builder $query) use ($value) {
            // $value = strtolower($value);
            // if(! isJoined($query, 'wh_product_pos')) $query->join('wh_product_pos', 'sl_offer_pos.wh_product_id', 'wh_product_pos.id');
        return  $query->whereIn('sl_offer_pos.wh_product_id', function($query) use ($value) {
                    $query->select('wh_product_pos.id')
                    ->from('wh_product_pos')
                    ->whereIn('wh_product_pos.upc', $value);
        });
        
    }
}
