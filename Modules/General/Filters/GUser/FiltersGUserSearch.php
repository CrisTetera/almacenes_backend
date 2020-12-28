<?php

namespace Modules\General\Filters\GUser;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersGUserSearch Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        $query->selectRaw('g_user.*')
            ->join('hr_employee', 'g_user.hr_employee_id', 'hr_employee.id');

        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            $query->orWhereRaw("LOWER(hr_employee.rut) like '%$value%'")
            ->orWhereRaw("LOWER(hr_employee.names) like '%$value%'")
            ->orWhereRaw("LOWER(hr_employee.last_name1) like '%$value%'")
            ->orWhereRaw("LOWER(hr_employee.last_name2) like '%$value%'");
        });
    }
}
