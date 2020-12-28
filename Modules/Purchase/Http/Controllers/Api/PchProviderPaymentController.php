<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchProviderPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchProviderPaymentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchProviderPayment::orderBy('id'))
                                ->allowedIncludes('pch_detail_provider_payment_sheet', 'pch_provider_account_movement',
                                                  'pch_detail_provider_payment_sheets', 'pch_provider_account_movements')
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
    * @param  int $idPchProviderPayment
    * @return \Illuminate\Http\Response
    */
    public function show($idPchProviderPayment)
    {
        return QueryBuilder::for(PchProviderPayment::where('id', $idPchProviderPayment))
                            ->allowedIncludes('pch_detail_provider_payment_sheet', 'pch_provider_account_movement',
                                              'pch_detail_provider_payment_sheets', 'pch_provider_account_movements')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchProviderPayment  $pchProviderPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(PchProviderPayment $pchProviderPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchProviderPayment  $pchProviderPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchProviderPayment $pchProviderPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchProviderPayment  $pchProviderPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchProviderPayment $pchProviderPayment)
    {
        //
    }
}
