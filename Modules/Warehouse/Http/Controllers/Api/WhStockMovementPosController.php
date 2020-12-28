<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Modules\Warehouse\Entities\WhStockMovementPos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class WhStockMovementPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhStockMovementPos::orderBy('id'))
                            ->allowedIncludes(
                                'wh_item',
                                'wh_warehouse',
                                'wh_warehouse_movement',
                                'wh_product_pos.wh_subfamily',
                                'wh_product_pos.wh_item',
                                'wh_product_pos.wh_pack',
                                'wh_product_pos.wh_promo'
                            )
                            ->allowedFilters(
                                Filter::exact('wh_item_id'),
                                Filter::exact('wh_warehouse_id'),
                                Filter::exact('wh_warehouse_movement_id'),
                                Filter::exact('pos_sale_id'),
                                Filter::exact('wh_product_id')
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
    public function show($idWhStockMovement)
    {
        return QueryBuilder::for(WhStockMovementPos::where('id', $idWhStockMovement))
                            ->allowedIncludes(
                                'wh_item',
                                'wh_warehouse',
                                'wh_warehouse_movement',
                                'wh_product.wh_subfamily',
                                'wh_product.wh_item',
                                'wh_product.wh_pack',
                                'wh_product.wh_packing',
                                'wh_product.wh_promo'
                            )
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhStockMovementPos  $whStockMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(WhStockMovement $whStockMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhStockMovementPos  $whStockMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhStockMovementPos $whStockMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhStockMovementPos  $whStockMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhStockMovementPos $whStockMovement)
    {
        //
    }
}
