<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlSaleInvoice;
use Illuminate\Http\Request;
use Modules\Sale\Http\Requests\SlSaleInvoice\GetLastSlSaleInvoice_OpenCashDeskRequest;
use Modules\Sale\Services\SlSaleInvoice\GetLastSlSaleInvoice_OpenCashDeskService;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class SlSaleInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlSaleInvoice::orderBy('id'))
                        ->allowedIncludes(
                            'sl_service_order_as_affected',
                            'sl_service_order_as_new',
                            'sl_customer_account_movement',
                            'sl_customer',
                            'sl_customer_branch_offices',
                            'sl_detail_sale_invoices',
                            'g_company',
                            'g_state'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_account_movement_id'),
                            Filter::exact('sl_customer_id'),
                            Filter::exact('sl_service_order_id'),
                            'number',
                            Filter::exact('was_replaced')
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
    public function show($idSlSaleInvoice)
    {
        return QueryBuilder::for(SlSaleInvoice::where('id', $idSlSaleInvoice))
                        ->allowedIncludes(
                            'sl_service_order_as_affected',
                            'sl_service_order_as_new',
                            'sl_customer_account_movement',
                            'sl_customer',
                            'sl_customer_branch_offices',
                            'sl_detail_sale_invoices',
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
        return QueryBuilder::for(SlSaleInvoice::where('number', $number))
                        ->allowedIncludes(
                            'sl_service_order_as_affected',
                            'sl_service_order_as_new',
                            'sl_customer',
                            'sl_detail_sale_invoices.wh_product',
                            'g_company'
                        )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlSaleInvoice  $slSaleInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlSaleInvoice $slSaleInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlSaleInvoice  $slSaleInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlSaleInvoice $slSaleInvoice)
    {
        //
    }

    /**
     * Get last SlSaleInvoice of open GCashDesk (Open in PosDailyCash)
     * 
     * @param  \Modules\Sale\Http\Requests\SlSaleInvoice\GetLastSlSaleInvoice_OpenCashDeskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function getLastSaleInvoiceOpenCashDesk(GetLastSlSaleInvoice_OpenCashDeskRequest $request)
    {
        $getLastSlSaleInvoice_OpenCashDeskService = new GetLastSlSaleInvoice_OpenCashDeskService();
        $response = $getLastSlSaleInvoice_OpenCashDeskService->getLastSaleInvoiceOpenCashDesk($request);

        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }

        return response()->json($response, $response['http_status_code']);
    } // end function
}
