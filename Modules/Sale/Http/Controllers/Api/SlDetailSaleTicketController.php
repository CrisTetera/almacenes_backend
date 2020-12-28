<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlDetailSaleTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;

class SlDetailSaleTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlDetailSaleTicket::orderBy('id'))
                        ->allowedIncludes(
                            'sl_sale_ticket.sl_customer',
                            'wh_product.wh_subfamily',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_sale_ticket_id'),
                            Filter::exact('wh_product_id')
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
    public function show($idSlDetailSaleTicket)
    {
        return QueryBuilder::for(SlDetailSaleTicket::where('id', $idSlDetailSaleTicket))
                        ->allowedIncludes(
                            'sl_sale_ticket.sl_customer',
                            'wh_product.wh_subfamily',
                            'wh_product.wh_item',
                            'wh_product.wh_pack',
                            'wh_product.wh_packing',
                            'wh_product.wh_promo'
                        )->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Sale\Entities\SlDetailSaleTicket  $slDetailSaleTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SlDetailSaleTicket $slDetailSaleTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlDetailSaleTicket  $slDetailSaleTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlDetailSaleTicket $slDetailSaleTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlDetailSaleTicket  $slDetailSaleTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlDetailSaleTicket $slDetailSaleTicket)
    {
        //
    }
}
