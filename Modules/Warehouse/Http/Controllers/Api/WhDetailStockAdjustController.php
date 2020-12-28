<?php

namespace Modules\Warehouse\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Warehouse\Entities\WhDetailStockAdjust;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhDetailStockAdjustController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(WhDetailStockAdjust::orderBy('id'))
                                ->allowedIncludes('wh_item', 'wh_stock_adjust')
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
    * @param  int $idWhDetailStockAdjust
    * @return \Illuminate\Http\Response
    */
    public function show($idWhDetailStockAdjust)
    {
        return QueryBuilder::for(WhDetailStockAdjust::where('id', $idWhDetailStockAdjust))
                            ->allowedIncludes('wh_item', 'wh_stock_adjust')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailStockAdjust  $whDetailStockAdjust
     * @return \Illuminate\Http\Response
     */
    public function edit(WhDetailStockAdjust $whDetailStockAdjust)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Warehouse\Entities\WhDetailStockAdjust  $whDetailStockAdjust
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhDetailStockAdjust $whDetailStockAdjust)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Warehouse\Entities\WhDetailStockAdjust  $whDetailStockAdjust
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhDetailStockAdjust $whDetailStockAdjust)
    {
        //
    }
}
