<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailProductReception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailProductReceptionController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailProductReception::orderBy('id'))
                                ->allowedIncludes('wh_product', 'wh_product_reception')
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
    * @param  int $idWhDetailProductReception
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailProductReception)
    {
        return QueryBuilder::for(WhDetailProductReception::where('id', $idWhDetailProductReception))
                            ->allowedIncludes('wh_product', 'wh_product_reception')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailProductReception  $whDetailProductReception
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailProductReception $whDetailProductReception)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailProductReception  $whDetailProductReception
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailProductReception $whDetailProductReception)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailProductReception  $whDetailProductReception
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailProductReception $whDetailProductReception)
    {
        //
    }
}
