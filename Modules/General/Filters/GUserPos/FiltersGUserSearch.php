<?php

namespace Modules\General\Filters\GUserPos;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersGUserSearch Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        $query->selectRaw('g_user_pos.*')
            ->join('hr_employee_pos', 'g_user_pos.hr_employee_id', 'hr_employee_pos.id');

        return $query->where(function (Builder $query) use ($value) {
            $value = strtolower($value);

            $query->orWhereRaw("LOWER(hr_employee_pos.rut) like '%$value%'")
            ->orWhereRaw("LOWER(hr_employee_pos.firstnames) like '%$value%'")
            ->orWhereRaw("LOWER(hr_employee_pos.last_name1) like '%$value%'")
            ->orWhereRaw("LOWER(hr_employee_pos.last_name2) like '%$value%'");
        });
    }
}
