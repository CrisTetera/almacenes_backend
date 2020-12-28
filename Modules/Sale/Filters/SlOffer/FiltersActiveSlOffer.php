<?php

namespace Modules\Sale\Filters\SlOffer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersActiveSlOffer implements Filter
{

    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return $query->where(function(Builder $query) use ($value) {
            if ( $value )
            {
                // now() returns a datetime for example 2019-02-08 11:23:06
                // casting datetime to date with ::date transform it to date 2019-02-08
                $query->whereRaw('init_datetime <= now()::date and now()::date <= finish_datetime');
            }
        });
    }

}
