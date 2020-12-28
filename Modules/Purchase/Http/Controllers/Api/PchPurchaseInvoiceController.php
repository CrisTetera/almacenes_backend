<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchPurchaseInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchPurchaseInvoiceController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchPurchaseInvoice::orderBy('id'))
                                ->allowedIncludes('pch_provider_account_movement', 'pch_provider', 'g_commune', 
                                                  'pch_detail_purchase_invoices', 'pch_provider_debt_to_pays', 'pch_purchase_debit_notes',
                                                  'pch_purchase_credit_notes', 'wh_dispatch_guides', 'pch_provider_account_movements')
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
    * @param  int $idPchPurchaseInvoice
    * @return \Illuminate\Http\Response
    */
    public function show($idPchPurchaseInvoice)
    {
        return QueryBuilder::for(PchPurchaseInvoice::where('id', $idPchPurchaseInvoice))
                            ->allowedIncludes('pch_provider_account_movement', 'pch_provider', 'g_commune', 
                                              'pch_detail_purchase_invoices', 'pch_provider_debt_to_pays', 'pch_purchase_debit_notes',
                                              'pch_purchase_credit_notes', 'wh_dispatch_guides', 'pch_provider_account_movements')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchPurchaseInvoice  $pchPurchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(PchPurchaseInvoice $pchPurchaseInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchPurchaseInvoice  $pchPurchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchPurchaseInvoice $pchPurchaseInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchPurchaseInvoice  $pchPurchaseInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchPurchaseInvoice $pchPurchaseInvoice)
    {
        //
    }
}
