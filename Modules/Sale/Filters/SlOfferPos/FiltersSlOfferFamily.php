<?php

namespace Modules\Sale\Filters\SlOfferPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferFamily implements Filter
{

    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if(! isInt($value) && ! isArrayOfInt($value)) $value = [-1]; // invalid ID tag
        if(! isArrayOfInt($value)) $value = [$value]; // pass single integer to array of single integer
        $value = array_unique($value); // delete duplicate of array
        
        return $query->whereIn('sl_offer_pos.wh_product_id', function($query) use ($value) {
            $query->join('wh_subfamily_pos', 'wh_product_pos.wh_subfamily_id', 'wh_subfamily_pos.id')
                  ->select('wh_product_pos.id')
                  ->from('wh_product_pos')
                  ->whereIn('wh_subfamily_pos.wh_family_id', $value);
        });
        // if(! isInt($value)) $value = -1; // invalid ID family
        // if(! isJoined($query, 'wh_product_pos')) $query->join('wh_product_pos', 'sl_offer_pos.wh_product_id', 'wh_product_pos.id');
        // return $query->join('wh_subfamily_pos', 'wh_product_pos.wh_subfamily_id', 'wh_subfamily_pos.id')
        //              ->where('wh_subfamily_pos.wh_family_id', $value);
    }

}
