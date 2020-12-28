<?php

namespace Modules\Warehouse\Sorts\WhProduct;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class WhProduct_SalePriceSort implements Sort
{
    public function __invoke(Builder $query, $descending, string $property) : Builder
    {
        dd("Hola Mundo");
        return $query->orderBy($property, $descending ? 'desc' : 'asc');
    }
}
