<?php

namespace Modules\Warehouse\Filters\FiltersWhProductMovementReport;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersWhProductMovementReportBetween Implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if(
            ! is_array($value) || 
            ! (count($value) === 2) || 
            ! verifyDate($value[0], $format = 'Y-m-d') || 
            ! verifyDate($value[1], $format = 'Y-m-d')
        ) 
        {
            $value[0] = '00-00-0000';
            $value[1] = '00-00-0000';
        } 
        
        return $query->where('wh_product_movement_report.date', '>=', $value[0]) // $value[0] => Init date filter
                     ->where('wh_product_movement_report.date', '<=', $value[1]); // $value[1] => Finish date filter
    } // end function
} // end class
