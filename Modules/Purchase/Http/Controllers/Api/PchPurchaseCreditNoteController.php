<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchPurchaseCreditNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchPurchaseCreditNoteController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchPurchaseCreditNote::orderBy('id'))
                                ->allowedIncludes('pch_provider_account_movement', 'g_commune', 'pch_purchase_invoice', 
                                                  'pch_detail_purchase_credit_notes', 'pch_provider_account_movements')
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
    * @param  int $idPchPurchaseCreditNote
    * @return \Illuminate\Http\Response
    */
    public function show($idPchPurchaseCreditNote)
    {
        return QueryBuilder::for(PchPurchaseCreditNote::where('id', $idPchPurchaseCreditNote))
                            ->allowedIncludes('pch_provider_account_movement', 'g_commune', 'pch_purchase_invoice', 
                                              'pch_detail_purchase_credit_notes', 'pch_provider_account_movements')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchPurchaseCreditNote  $pchPurchaseCreditNote
     * @return \Illuminate\Http\Response
     */
    public function edit(PchPurchaseCreditNote $pchPurchaseCreditNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchPurchaseCreditNote  $pchPurchaseCreditNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchPurchaseCreditNote $pchPurchaseCreditNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchPurchaseCreditNote  $pchPurchaseCreditNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchPurchaseCreditNote $pchPurchaseCreditNote)
    {
        //
    }
}
