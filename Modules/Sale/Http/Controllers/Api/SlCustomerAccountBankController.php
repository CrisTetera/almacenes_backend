<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlCustomerAccountBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlCustomerAccountBankController extends Controller
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
                            ->allowedIncludes('sl_customer', 'g_bank', 'g_type_account_bank')
                            ->allowedFilters(
                                Filter::exact('g_bank_id'),
                                Filter::exact('sl_customer_id'),
                                Filter::exact('g_type_account_bank'),
                                'number',
                                'rut',
                                'email')
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
                            ->allowedIncludes('sl_customer', 'g_bank', 'g_type_account_bank')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccountBank  $slCustomerAccountBank
     * @return \Illuminate\Http\Response
     */
    public function edit(SlCustomerAccountBank $slCustomerAccountBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlCustomerAccountBank  $slCustomerAccountBank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlCustomerAccountBank $slCustomerAccountBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlCustomerAccountBank  $slCustomerAccountBank
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlCustomerAccountBank $slCustomerAccountBank)
    {
        //
    }
}
