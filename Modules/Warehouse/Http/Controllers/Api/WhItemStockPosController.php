<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhItemStockPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class WhItemStockPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhItemStockPos::orderBy('id'))
                            ->allowedIncludes(
                                'wh_warehouse_pos',
                                'wh_item_pos.wh_product_pos'
                            )
                            ->allowedFilters(
                                Filter::exact('wh_item_id')
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
    public function show($idWhWarehouseItem)
    {
        return QueryBuilder::for(WhtemStockPos::where('id', $idWhWarehouseItem))
                            ->allowedIncludes(
                                'wh_warehouse_pos',
                                'wh_item_pos.wh_products'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhItemStockpos  $whWarehouseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(WhWarehouseItem $whWarehouseItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhItemStockPos  $whWarehouseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhWarehouseItem $whWarehouseItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhItemStockPos  $whWarehouseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhWarehouseItem $whWarehouseItem)
    {
        //
    }
}
