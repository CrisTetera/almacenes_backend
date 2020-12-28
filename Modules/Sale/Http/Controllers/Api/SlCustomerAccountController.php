<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class SlCustomerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlCustomerAccountBank::orderBy('id'))
                            ->allowedIncludes('sl_customer')
                            ->allowedFilters(
                                Filter::exact('sl_customer_id'))
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
    public function show($idSlCustomerAccountBank)
    {
        return QueryBuilder::for(SlCustomerAccountBank::where('id', $idSlCustomerAccountBank))
                            ->allowedIncludes('sl_customer')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccount  $slCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCustomerAccount $slCustomerAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCustomerAccount  $slCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCustomerAccount $slCustomerAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccount  $slCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCustomerAccount $slCustomerAccount)
    {
        //
    }
}
