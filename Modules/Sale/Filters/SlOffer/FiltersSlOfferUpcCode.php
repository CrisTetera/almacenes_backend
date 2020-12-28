<?php

namespace Modules\Sale\Filters\SlOffer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferUpcCode Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);
            if(! isJoined($query, 'wh_product')) $query->join('wh_product', 'sl_offer.wh_product_id', 'wh_product.id');
            return $query->whereRaw("wh_product.id IN
                                    (SELECT wh_product_id
                                    FROM wh_product_upc_code
                                    WHERE upc_code like '%$value%')");
        });
    }
}
