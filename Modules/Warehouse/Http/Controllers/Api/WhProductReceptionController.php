<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhProductReception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhProductReceptionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhProductReception::orderBy('id'))
                                ->allowedIncludes('pch_purchase_order', 'pch_purchase_orders', 
                                                  'wh_detail_product_receptions')
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
    * @param  int $idWhProductReception
    * @return \Illuminate\Http\Response
    */
    public function show($idWhProductReception)
    {
        return QueryBuilder::for(WhProductReception::where('id', $idWhProductReception))
                            ->allowedIncludes('pch_purchase_order', 'pch_purchase_orders', 
                                              'wh_detail_product_receptions')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhProductReception  $whProductReception
     * @return \Illuminate\Http\Response
     */
    public function edit(WhProductReception $whProductReception)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhProductReception  $whProductReception
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhProductReception $whProductReception)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhProductReception  $whProductReception
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhProductReception $whProductReception)
    {
        //
    }
}
