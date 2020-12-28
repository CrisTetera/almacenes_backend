<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlSaleDebitNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlSaleDebitNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlSaleDebitNote::orderBy('id'))
                        ->allowedIncludes(
                            'sl_customer_account_movement',
                            'sl_customer',
                            'sl_detail_sale_debit_notes'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_account_movement_id'),
                            Filter::exact('sl_customer_id'),
                            'number'
                        )
                        ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
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
     * @return \Illuminate\Http\Response
     */
    public function show($idSlSaleDebitNote)
    {
        return QueryBuilder::for(SlSaleDebitNote::where('id', $idSlSaleDebitNote))
                        ->allowedIncludes(
                            'sl_customer_account_movement',
                            'sl_customer',
                            'sl_detail_sale_debit_notes'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlSaleDebitNote  $slSaleDebitNote
     * @return \Illuminate\Http\Response
     */
    public function edit(SlSaleDebitNote $slSaleDebitNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlSaleDebitNote  $slSaleDebitNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlSaleDebitNote $slSaleDebitNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlSaleDebitNote  $slSaleDebitNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlSaleDebitNote $slSaleDebitNote)
    {
        //
    }
}
