<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlSaleTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlSaleTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlSaleTicket::orderBy('id'))
                        ->allowedIncludes(
                            'sl_service_order_as_affected',
                            'sl_service_order_as_new',
                            'sl_customer',
                            'sl_detail_sale_tickets.wh_product',
                            'g_company'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_service_order_id'),
                            Filter::exact('sl_service_order_id2'),
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
    public function show($idSlSaleTicket)
    {
        return QueryBuilder::for(SlSaleTicket::where('id', $idSlSaleTicket))
                        ->allowedIncludes(
                            'sl_service_order_as_affected',
                            'sl_service_order_as_new',
                            'sl_customer',
                            'sl_detail_sale_tickets.wh_product',
                            'g_company'
                        )->first();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByNumber($number)
    {
        return QueryBuilder::for(SlSaleTicket::where('number', $number))
                        ->allowedIncludes(
                            'sl_service_order_as_affected',
                            'sl_service_order_as_new',
                            'sl_customer',
                            'sl_detail_sale_tickets.wh_product',
                            'g_company'
                        )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlSaleTicket  $slSaleTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlSaleTicket $slSaleTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlSaleTicket  $slSaleTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlSaleTicket $slSaleTicket)
    {
        //
    }
}
