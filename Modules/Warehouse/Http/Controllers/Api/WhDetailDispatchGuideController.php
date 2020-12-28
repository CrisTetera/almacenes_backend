<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailDispatchGuide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailDispatchGuideController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailDispatchGuide::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_dispatch_guide')
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
    * @param  int $idWhDetailDispatchGuide
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailDispatchGuide)
    {
        return QueryBuilder::for(WhDetailDispatchGuide::where('id', $idWhDetailDispatchGuide))
                            ->allowedIncludes('wh_product', 'wh_dispatch_guide')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailDispatchGuide  $whDetailDispatchGuide
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailDispatchGuide $whDetailDispatchGuide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailDispatchGuide  $whDetailDispatchGuide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailDispatchGuide $whDetailDispatchGuide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailDispatchGuide  $whDetailDispatchGuide
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailDispatchGuide $whDetailDispatchGuide)
    {
        //
    }
}
