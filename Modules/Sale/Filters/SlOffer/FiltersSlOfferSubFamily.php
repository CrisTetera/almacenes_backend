<?php

namespace Modules\Sale\Filters\SlOffer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferSubFamily implements Filter
{

    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if(! isInt($value)) $value = -1; // invalid ID family
        if(! isJoined($query, 'wh_product')) $query->join('wh_product', 'sl_offer.wh_product_id', 'wh_product.id');
        return $query->selectRaw('sl_offer.*')
                     ->where('wh_product.wh_subfamily_id', $value);
    }
}
