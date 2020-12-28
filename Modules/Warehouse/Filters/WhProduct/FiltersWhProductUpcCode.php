<?php

namespace Modules\Warehouse\Filters\WhProduct;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductUpcCode Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            $query->whereRaw("wh_product.id IN
                              (SELECT wh_product_id
                               FROM wh_product_upc_code
                               WHERE upc_code like '%$value%')");
        });
    }
}
