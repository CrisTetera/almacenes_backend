<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailTransferBetweenWarehouseController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailTransferBetweenWarehouse::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_transfer_between_warehouse')
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
    * @param  int $idWhDetailTransferBetweenWarehouse
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailTransferBetweenWarehouse)
    {
        return QueryBuilder::for(WhDetailTransferBetweenWarehouse::where('id', $idWhDetailTransferBetweenWarehouse))
                            ->allowedIncludes('wh_product', 'wh_transfer_between_warehouse')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse  $whDetailTransferBetweenWarehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailTransferBetweenWarehouse $whDetailTransferBetweenWarehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse  $whDetailTransferBetweenWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailTransferBetweenWarehouse $whDetailTransferBetweenWarehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailTransferBetweenWarehouse  $whDetailTransferBetweenWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailTransferBetweenWarehouse $whDetailTransferBetweenWarehouse)
    {
        //
    }
}
