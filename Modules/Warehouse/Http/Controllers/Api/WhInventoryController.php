<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhInventoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhInventory::orderBy('id'))
                                ->allowedIncludes('g_user_supervisor', 'g_state', 'g_user_warehouseman', 'wh_warehouse', 
                                                  'wh_stock_adjust', 'wh_detail_inventories', 'wh_detail_inventories.wh_product')
                                //->allowedFilters([''])
                                ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else
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
    * @param  int $idWhInventory
    * @return \Illuminate\Http\Response
    */
    public function show($idWhInventory)
    {
        return QueryBuilder::for(WhInventory::where('id', $idWhInventory))
                            ->allowedIncludes('g_user_supervisor', 'g_state', 'g_user_warehouseman', 'wh_warehouse', 
                                              'wh_stock_adjust', 'wh_detail_inventories', 'wh_detail_inventories.wh_product')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhInventory  $whInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(WhInventory $whInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhInventory  $whInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhInventory $whInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhInventory  $whInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhInventory $whInventory)
    {
        //
    }
}
