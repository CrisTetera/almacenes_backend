<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhProductMovementReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Modules\Warehouse\Filters\WhProduct\FiltersWhProductSearch;
use Modules\Warehouse\Filters\FiltersWhProductMovementReport\FiltersWhProductMovementReportProducts;
use Modules\Warehouse\Filters\FiltersWhProductMovementReport\FiltersWhProductMovementReportBetween;

class WhProductMovementReportController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhProductMovementReport::whereRaw('1 = 1'))
                                ->allowedIncludes('wh_product')
                                ->allowedFilters(
                                    Filter::custom('products', FiltersWhProductMovementReportProducts::class),
                                    Filter::custom('between', FiltersWhProductMovementReportBetween::class)
                                )
                                ->defaultSort('date')
                                ->allowedSorts(
                                    'wh_product_id', 
                                    'date', 
                                    'normal_sale_quantity', 
                                    'ground_sale_quantity', 
                                    'waste_quantity', 
                                    'adjust_quantity', 
                                    'purchase_quantity'
                                );

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else {
            $data = $query->paginate($request->limit);
            return $data;
        }
    }

} // end class
