<?php

namespace Modules\General\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\General\Entities\AuditHistoricPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditHistoricPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(AuditHistoricPrice::orderBy('id'))
                                ->allowedIncludes('g_user', 'sl_list_price', 'wh_product')
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
     * @param  int  $idAuditHistoricPrice
     * @return \Illuminate\Http\Response
     */
    public function show($idAuditHistoricPrice)
    {
        return QueryBuilder::for(AuditHistoricPrice::where('id', $idAuditHistoricPrice))
                           ->allowedIncludes('g_user', 'sl_list_price', 'wh_product')
                           ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Entities\AuditHistoricPrice  $auditHistoricPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditHistoricPrice $auditHistoricPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\General\Entities\AuditHistoricPrice  $auditHistoricPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditHistoricPrice $auditHistoricPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Entities\AuditHistoricPrice  $auditHistoricPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditHistoricPrice $auditHistoricPrice)
    {
        //
    }
}
