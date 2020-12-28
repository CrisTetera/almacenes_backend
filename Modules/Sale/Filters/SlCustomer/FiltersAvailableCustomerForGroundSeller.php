<?php

namespace Modules\Sale\Filters\SlCustomer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersAvailableCustomerForGroundSeller Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $query->whereRaw("sl_customer.id NOT IN
                              (
                                SELECT sl_customer_id
                                FROM sl_customer_ground_seller
                              )");
        });
    }
}
