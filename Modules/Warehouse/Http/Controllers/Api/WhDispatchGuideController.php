<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDispatchGuide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDispatchGuideController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDispatchGuide::orderBy('id'))
                                ->allowedIncludes('g_user', 'pch_purchase_invoice', 'sl_customer', 
                                                  'wh_detail_dispatch_guides', 'wh_detail_dispatch_orders')
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
    * @param  int $idWhDispatchGuide
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDispatchGuide)
    {
        return QueryBuilder::for(WhDispatchGuide::where('id', $idWhDispatchGuide))
                            ->allowedIncludes('g_user', 'pch_purchase_invoice', 'sl_customer', 
                                              'wh_detail_dispatch_guides', 'wh_detail_dispatch_orders')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDispatchGuide  $whDispatchGuide
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDispatchGuide $whDispatchGuide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDispatchGuide  $whDispatchGuide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDispatchGuide $whDispatchGuide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDispatchGuide  $whDispatchGuide
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDispatchGuide $whDispatchGuide)
    {
        //
    }
}
