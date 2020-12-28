<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchDetailPurchaseQuotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PchDetailPurchaseQuotationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchDetailPurchaseQuotation::orderBy('id'))
                                ->allowedIncludes('pch_purchase_quotation', 'wh_product')
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
    * @param  int $idPchDetailPurchaseQuotation
    * @return \Illuminate\Http\Response
    */
    public function show($idPchDetailPurchaseQuotation)
    {
        return QueryBuilder::for(PchDetailPurchaseQuotation::where('id', $idPchDetailPurchaseQuotation))
                            ->allowedIncludes('pch_purchase_quotation', 'wh_product')
                            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Purchase\Entities\PchDetailPurchaseQuotation  $pchDetailPurchaseQuotation
     * @return \Illuminate\Http\Response
     */
    public function edit(PchDetailPurchaseQuotation $pchDetailPurchaseQuotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Purchase\Entities\PchDetailPurchaseQuotation  $pchDetailPurchaseQuotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PchDetailPurchaseQuotation $pchDetailPurchaseQuotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Purchase\Entities\PchDetailPurchaseQuotation  $pchDetailPurchaseQuotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PchDetailPurchaseQuotation $pchDetailPurchaseQuotation)
    {
        //
    }
}
