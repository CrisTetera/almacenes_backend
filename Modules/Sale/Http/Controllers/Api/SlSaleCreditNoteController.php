<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlSaleCreditNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlSaleCreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlSaleCreditNote::orderBy('id'))
                        ->allowedIncludes(
                            'sl_customer_account_movement',
                            'sl_customer',
                            'sl_service_order',
                            'sl_detail_sale_credit_notes'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_account_movement_id'),
                            Filter::exact('sl_customer_id'),
                            Filter::exact('sl_service_order_id'),
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
    public function show($idSlSaleCreditNote)
    {
        return QueryBuilder::for(SlSaleCreditNote::where('id', $idSlSaleCreditNote))
                        ->allowedIncludes(
                            'sl_customer_account_movement',
                            'sl_customer',
                            'sl_service_order',
                            'sl_detail_sale_credit_notes'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlSaleCreditNote  $slSaleCreditNote
     * @return \Illuminate\Http\Response
     */
    public function edit(SlSaleCreditNote $slSaleCreditNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlSaleCreditNote  $slSaleCreditNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlSaleCreditNote $slSaleCreditNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlSaleCreditNote  $slSaleCreditNote
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlSaleCreditNote $slSaleCreditNote)
    {
        //
    }
}
