<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlChangeSalePrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlChangeSalePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlChangeSalePrice::orderBy('id'))
                            ->allowedIncludes('wh_product')
                            ->allowedFilters(Filter::exact('wh_product_id'))
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
    public function show($idSlChangeSalePrice)
    {
        return QueryBuilder::for(SlChangeSalePrice::where('id', $idSlChangeSalePrice))
                            ->allowedIncludes('wh_product')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlChangeSalePrice  $slChangeSalePrice
     * @return \Illuminate\Http\Response
     */
    public function edit(SlChangeSalePrice $slChangeSalePrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlChangeSalePrice  $slChangeSalePrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlChangeSalePrice $slChangeSalePrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlChangeSalePrice  $slChangeSalePrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlChangeSalePrice $slChangeSalePrice)
    {
        //
    }
}
