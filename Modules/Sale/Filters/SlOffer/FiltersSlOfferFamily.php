<?php

namespace Modules\Sale\Filters\SlOffer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersSlOfferFamily implements Filter
{

    public function __invoke(Builder $query, $value, string $property): Builder
    {
        if(! isInt($value)) $value = -1; // invalid ID family
        if(! isJoined($query, 'wh_product')) $query->join('wh_product', 'sl_offer.wh_product_id', 'wh_product.id');
        return $query->selectRaw('sl_offer.*')
                     ->join('wh_subfamily', 'wh_product.wh_subfamily_id', 'wh_subfamily.id')
                     ->where('wh_subfamily.wh_family_id', $value);
    }

}
