<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhStockAdjust;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class WhStockAdjustController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhStockAdjust::orderBy('id'))
                            ->allowedIncludes(
                                'wh_inventory',
                                'g_user',
                                'wh_warehouse',
                                'wh_stock_adjust_type',
                                'wh_detail_stock_adjusts'
                            )
                            ->allowedFilters(
                                Filter::exact('wh_inventory_id'),
                                Filter::exact('g_user_id'),
                                Filter::exact('wh_warehouse_id'),
                                Filter::exact('wh_stock_adjust_type_id'),
                                'description'
                            )
                            ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idWhStockAdjust)
    {
        return QueryBuilder::for(WhStockAdjust::where('id', $idWhStockAdjust))
                            ->allowedIncludes(
                                'wh_inventory',
                                'g_user',
                                'wh_warehouse',
                                'wh_stock_adjust_type',
                                'wh_detail_stock_adjusts'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhStockAdjust  $whStockAdjust
     * @return \Illuminate\Http\Response
     */
    public function edit(WhStockAdjust $whStockAdjust)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhStockAdjust  $whStockAdjust
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhStockAdjust $whStockAdjust)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhStockAdjust  $whStockAdjust
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhStockAdjust $whStockAdjust)
    {
        //
    }
}
