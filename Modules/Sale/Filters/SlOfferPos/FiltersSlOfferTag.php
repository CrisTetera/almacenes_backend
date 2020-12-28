<?php

namespace Modules\Sale\Filters\SlOfferPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferTag implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value); // delete duplicate of array
        
        // if(! isJoined($query, 'wh_product_pos')) $query->join('wh_product_pos', 'sl_offer_pos.wh_product_id', 'wh_product_pos.id');

        return $query->whereIn('sl_offer_pos.wh_product_id', function($query) use ($value) {
            $query->select('wh_tag_wh_product_pos.wh_product_id')
                  ->from('wh_tag_wh_product_pos')
                  ->whereIn('wh_tag_wh_product_pos.wh_tag_id', $value);
        });
        // return $query->join('wh_tag_wh_product_pos', 'wh_product_pos.id', 'wh_tag_wh_product_pos.wh_product_id')
        //             ->whereIn('wh_tag_wh_product_pos.wh_tag_id', $value);
                    // ->groupBy('sl_offer_pos.id')
                    // ->having(\DB::raw('count(*)'), '=', count($value));
    }
}
