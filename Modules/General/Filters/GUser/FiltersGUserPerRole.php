<?php

namespace Modules\General\Filters\GUser;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersGUserPerRole Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            $query->whereRaw("g_user.id IN ( SELECT model_id FROM model_has_roles WHERE role_id = ? )", [$value]);
        });
    }
}
