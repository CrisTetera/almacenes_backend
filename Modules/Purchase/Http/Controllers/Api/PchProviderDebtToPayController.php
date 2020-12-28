<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchProviderDebtToPay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchProviderDebtToPayController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchProviderDebtToPay::orderBy('id'))
                                ->allowedIncludes('pch_provider_account', 'pch_purchase_invoice', 'pch_detail_provider_payment_sheets')
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
    * @param  int $idPchProviderDebtToPay
    * @return \Illuminate\Http\Response
    */
    public function show($idPchProviderDebtToPay)
    {
        return QueryBuilder::for(PchProviderDebtToPay::where('id', $idPchProviderDebtToPay))
                            ->allowedIncludes('pch_provider_account', 'pch_purchase_invoice', 'pch_detail_provider_payment_sheets')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchProviderDebtToPay  $pchProviderDebtToPay
     * @return \Illuminate\Http\Response
     */
    public function edit(PchProviderDebtToPay $pchProviderDebtToPay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchProviderDebtToPay  $pchProviderDebtToPay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchProviderDebtToPay $pchProviderDebtToPay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchProviderDebtToPay  $pchProviderDebtToPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchProviderDebtToPay $pchProviderDebtToPay)
    {
        //
    }
}
