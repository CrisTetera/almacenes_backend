<?php

namespace Modules\Warehouse\Filters\WhProductPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductTypes Implements Filter
{
    public function __invoke(Builder $query, $values, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($values) {
            foreach( $values as $i => $value ) {
                $value = strtolower($value);
                if ($value === 'item') {
                    $query->orWhereRaw("wh_item_id IS NOT NULL");
                }
                if ($value === 'pack') {
                    $query->orWhereRaw("wh_pack_id IS NOT NULL");
                }
                if ($value === 'promo') {
                    $query->orWhereRaw("wh_promo_id IS NOT NULL");
                }
            }

        });
    }
}
