<?php

namespace Modules\Sale\Filters\SlOffer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferTag implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value); // delete duplicate of array
        
        if(! isJoined($query, 'wh_product')) $query->join('wh_product', 'sl_offer.wh_product_id', 'wh_product.id');

        return $query->selectRaw('sl_offer.*')
                    ->join('wh_tag_wh_product', 'wh_product.id', 'wh_tag_wh_product.wh_product_id')
                    ->whereIn('wh_tag_wh_product.wh_tag_id', $value)
                    ->groupBy('sl_offer.id')
                    ->having(\DB::raw('count(*)'), '=', count($value));
    }
}
