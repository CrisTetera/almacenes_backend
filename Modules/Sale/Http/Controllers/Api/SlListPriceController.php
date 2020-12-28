<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlListPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlListPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlListPrice::orderBy('id'))
                        ->allowedIncludes(
                            'g_branch_office',
                            'sl_detail_list_prices'
                        )
                        ->allowedFilters(
                            Filter::exact('g_branch_office_id'),
                            'name',
                            'description'
                        )
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
    public function show($idSlListPrice)
    {
        return QueryBuilder::for(SlListPrice::where('id', $idSlListPrice))
                        ->allowedIncludes(
                            'g_branch_office',
                            'sl_detail_list_prices'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlListPrice  $slListPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(SlListPrice $slListPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlListPrice  $slListPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlListPrice $slListPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlListPrice  $slListPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlListPrice $slListPrice)
    {
        //
    }
}
