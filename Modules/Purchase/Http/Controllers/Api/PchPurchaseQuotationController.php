<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchPurchaseQuotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchPurchaseQuotationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchPurchaseQuotation::orderBy('id'))
                                ->allowedIncludes('pch_provider', 'g_state', 'pch_detail_purchase_quotations')
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
    * @param  int $idPchPurchaseQuotation
    * @return \Illuminate\Http\Response
    */
    public function show($idPchPurchaseQuotation)
    {
        return QueryBuilder::for(PchPurchaseQuotation::where('id', $idPchPurchaseQuotation))
                            ->allowedIncludes('pch_provider', 'g_state', 'pch_detail_purchase_quotations')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchPurchaseQuotation  $pchPurchaseQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit(PchPurchaseQuotation $pchPurchaseQuotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchPurchaseQuotation  $pchPurchaseQuotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchPurchaseQuotation $pchPurchaseQuotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchPurchaseQuotation  $pchPurchaseQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchPurchaseQuotation $pchPurchaseQuotation)
    {
        //
    }
}
