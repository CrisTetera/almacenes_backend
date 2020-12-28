<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchDetailProviderPaymentSheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchDetailProviderPaymentSheetController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchDetailProviderPaymentSheet::orderBy('id'))
                                ->allowedIncludes('pch_provider_account_bank', 'pch_provider_payment', 'pch_provider_account', 'pch_provider_payment_sheet', 'pch_provider_debt_to_pays', 'pch_provider_payments')
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
    * @param  int $idPchDetailProviderPaymentSheet
    * @return \Illuminate\Http\Response
    */
    public function show($idPchDetailProviderPaymentSheet)
    {
        return QueryBuilder::for(PchDetailProviderPaymentSheet::where('id', $idPchDetailProviderPaymentSheet))
                            ->allowedIncludes('pch_provider_account_bank', 'pch_provider_payment', 'pch_provider_account', 'pch_provider_payment_sheet', 'pch_provider_debt_to_pays', 'pch_provider_payments')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchDetailProviderPaymentSheet  $pchDetailProviderPaymentSheet
     * @return \Illuminate\Http\Response
     */
    public function edit(PchDetailProviderPaymentSheet $pchDetailProviderPaymentSheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchDetailProviderPaymentSheet  $pchDetailProviderPaymentSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchDetailProviderPaymentSheet $pchDetailProviderPaymentSheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchDetailProviderPaymentSheet  $pchDetailProviderPaymentSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchDetailProviderPaymentSheet $pchDetailProviderPaymentSheet)
    {
        //
    }
}
