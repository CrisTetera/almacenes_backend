<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerPresetsDiscount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlCustomerPresetsDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCustomerPresetsDiscount::orderBy('id'))
                        ->allowedIncludes(
                            'sl_customer'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_id')
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
    public function show($idSlCustomerPresetsDiscount)
    {
        return QueryBuilder::for(SlCustomerPresetsDiscount::where('id', $idSlCustomerPresetsDiscount))
                        ->allowedIncludes(
                            'sl_customer'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCustomerPresetsDiscount  $slCustomerPresetsDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCustomerPresetsDiscount $slCustomerPresetsDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCustomerPresetsDiscount  $slCustomerPresetsDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCustomerPresetsDiscount $slCustomerPresetsDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCustomerPresetsDiscount  $slCustomerPresetsDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCustomerPresetsDiscount $slCustomerPresetsDiscount)
    {
        //
    }
}
