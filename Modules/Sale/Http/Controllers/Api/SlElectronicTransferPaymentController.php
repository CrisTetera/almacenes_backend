<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlElectronicTransferPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlElectronicTransferPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlElectronicTransferPayment::orderBy('id'))
                        ->allowedIncludes(
                            'sl_customer_account_bank.g_bank',
                            'sl_customer_account_bank.g_type_account_bank',
                            'sl_customer_account_bank.sl_customer'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_account_bank_id')
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
    public function show($idSlElectronicTransferPayment)
    {
        return QueryBuilder::for(SlElectronicTransferPayment::where('id', $idSlElectronicTransferPayment))
                        ->allowedIncludes(
                            'sl_customer_account_bank.g_bank',
                            'sl_customer_account_bank.g_type_account_bank',
                            'sl_customer_account_bank.sl_customer'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlElectronicTransferPayment  $slElectronicTransferPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SlElectronicTransferPayment $slElectronicTransferPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlElectronicTransferPayment  $slElectronicTransferPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlElectronicTransferPayment $slElectronicTransferPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlElectronicTransferPayment  $slElectronicTransferPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlElectronicTransferPayment $slElectronicTransferPayment)
    {
        //
    }
}
