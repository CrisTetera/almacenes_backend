<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchDetailPurchaseDebitNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchDetailPurchaseDebitNoteController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchDetailPurchaseDebitNote::orderBy('id'))
                                ->allowedIncludes('pch_purchase_debit_note', 'wh_product')
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
    * @param  int $idPchDetailPurchaseDebitNote
    * @return \Illuminate\Http\Response
    */
    public function show($idPchDetailPurchaseDebitNote)
    {
        return QueryBuilder::for(PchDetailPurchaseDebitNote::where('id', $idPchDetailPurchaseDebitNote))
                            ->allowedIncludes('pch_purchase_debit_note', 'wh_product')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchDetailPurchaseDebitNote  $pchDetailPurchaseDebitNote
     * @return \Illuminate\Http\Response
     */
    public function edit(PchDetailPurchaseDebitNote $pchDetailPurchaseDebitNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchDetailPurchaseDebitNote  $pchDetailPurchaseDebitNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchDetailPurchaseDebitNote $pchDetailPurchaseDebitNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchDetailPurchaseDebitNote  $pchDetailPurchaseDebitNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchDetailPurchaseDebitNote $pchDetailPurchaseDebitNote)
    {
        //
    }
}
