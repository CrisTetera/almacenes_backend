<?php

namespace Modules\Sale\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sale\Entities\SlSaleTicket;
use Modules\Sale\Entities\SlSaleInvoice;

class SlDTEController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
    }

    /**
     * Show DTE (ticker ot invoice) by number
     * @param Illuminate\Http\Request $request
     * @param integer $number
     * @return Response
     */
    public function searchByNumber(Request $request, $number)
    {
        if ($request->has('is_ticket') && $request->is_ticket) {
            return SlSaleTicket::with('slDetailSaleTickets.whProduct')
                                ->where('number', $number)->firstOrFail();
        } else {
            return SlSaleInvoice::with('slDetailSaleInvoices.whProduct')
                                ->with('slCustomer.gCommune')
                                ->where('number', $number)->firstOrFail();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
