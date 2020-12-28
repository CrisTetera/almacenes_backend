<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductType Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);
            if ($value === 'item') {
                $query->whereRaw("wh_item_id IS NOT NULL");
            } else if ($value === 'pack') {
                $query->whereRaw("wh_pack_id IS NOT NULL");
            } else if ($value === 'packing') {
                $query->whereRaw("wh_packing_id IS NOT NULL");
            } else if ($value === 'promo') {
                $query->whereRaw("wh_promo_id IS NOT NULL");
            }
        });
    }
}
