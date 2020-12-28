<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailDispatchOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailDispatchOrderController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailDispatchOrder::orderBy('id'))
                                ->allowedIncludes('wh_dispatch_guide', 'wh_dispatch_order')
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
    * @param  int $idWhDetailDispatchOrder
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailDispatchOrder)
    {
        return QueryBuilder::for(WhDetailDispatchOrder::where('id', $idWhDetailDispatchOrder))
                            ->allowedIncludes('wh_dispatch_guide', 'wh_dispatch_order')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailDispatchOrder  $whDetailDispatchOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailDispatchOrder $whDetailDispatchOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailDispatchOrder  $whDetailDispatchOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailDispatchOrder $whDetailDispatchOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailDispatchOrder  $whDetailDispatchOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailDispatchOrder $whDetailDispatchOrder)
    {
        //
    }
}
