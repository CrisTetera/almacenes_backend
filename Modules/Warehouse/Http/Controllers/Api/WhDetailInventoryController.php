<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailInventoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailInventory::orderBy('id'))
                                ->allowedIncludes('wh_inventory', 'wh_product')
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
    * @param  int $idWhDetailInventory
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailInventory)
    {
        return QueryBuilder::for(WhDetailInventory::where('id', $idWhDetailInventory))
                            ->allowedIncludes('wh_inventory', 'wh_product')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailInventory  $whDetailInventory
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailInventory $whDetailInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailInventory  $whDetailInventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailInventory $whDetailInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailInventory  $whDetailInventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailInventory $whDetailInventory)
    {
        //
    }
}
