<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchProviderAccountMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchProviderAccountMovementController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchProviderAccountMovement::orderBy('id'))
                                ->allowedIncludes('pch_provider_account', 'pch_purchase_credit_note', 'pch_purchase_debit_note',
                                                  'pch_purchase_invoice', 'pch_type_provider_account_movement', 'pch_provider_payment',
                                                  'pch_purchase_debit_notes', 'pch_purchase_invoices', 'pch_purchase_credit_notes',
                                                  'pch_provider_payments')
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
    * @param  int $idPchProviderAccountMovement
    * @return \Illuminate\Http\Response
    */
    public function show($idPchProviderAccountMovement)
    {
        return QueryBuilder::for(PchProviderAccountMovement::where('id', $idPchProviderAccountMovement))
                            ->allowedIncludes('pch_provider_account', 'pch_purchase_credit_note', 'pch_purchase_debit_note',
                                              'pch_purchase_invoice', 'pch_type_provider_account_movement', 'pch_provider_payment',
                                              'pch_purchase_debit_notes', 'pch_purchase_invoices', 'pch_purchase_credit_notes',
                                              'pch_provider_payments')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchProviderAccountMovement  $pchProviderAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(PchProviderAccountMovement $pchProviderAccountMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchProviderAccountMovement  $pchProviderAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchProviderAccountMovement $pchProviderAccountMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchProviderAccountMovement  $pchProviderAccountMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchProviderAccountMovement $pchProviderAccountMovement)
    {
        //
    }
}
