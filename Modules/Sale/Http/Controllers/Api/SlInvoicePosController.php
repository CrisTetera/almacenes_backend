<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlInvoicePos;
use Illuminate\Http\Request;
use Modules\Sale\Http\Requests\SlSaleInvoicePos\GetLastSlSaleInvoice_OpenCashDeskRequest;
use Modules\Sale\Services\SlSaleInvoicePos\GetLastSlSaleInvoice_OpenCashDeskService;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class SlInvoicePosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlInvoicePos::orderBy('id'))
                        ->allowedIncludes(
                            // 'sl_service_order_as_affected',
                            // 'sl_service_order_as_new',
                            // 'sl_customer_account_movement',
                            'sl_customer_pos',
                            // 'sl_customer_branch_offices',
                            'pos_detail_pos',
                            'g_company_pos',
                            'g_state_pos'
                        )
                        ->allowedAppends(
                            'invoice_detail'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_customer_id'),
                            // Filter::exact('sl_service_order_id'),
                            'invoice_number',
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
        return QueryBuilder::for(SlInvoicePos::where('id', $idSlSaleInvoice))
                        ->allowedIncludes(
                            // 'sl_service_order_as_affected',
                            // 'sl_service_order_as_new',
                            // 'sl_customer_account_movement',
                            'sl_customer_pos',
                            // 'sl_customer_branch_offices',
                            'pos_detail_pos',
                            'g_company_pos'
                        )->allowedAppends(
                            'invoice_detail'
                        )->first();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByNumber($number)
    {
        return QueryBuilder::for(SlInvoicePos::where('invoice_number', $number))
                        ->allowedIncludes(
                            // 'sl_service_order_as_affected',
                            // 'sl_service_order_as_new',
                            'sl_customer_pos',
                            'sl_detail_sale_invoices.wh_product',
                            'g_company_pos'
                        )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlInvoicePos  $slSaleInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlInvoicePos $slSaleInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlInvoicePos  $slSaleInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlInvoicePos $slSaleInvoice)
    {
        //
    }

    /**
     * Get last SlSaleInvoice of open GCashDesk (Open in PosDailyCash)
     * 
     * @param  \Modules\Sale\Http\Requests\SlSaleInvoicePos\GetLastSlSaleInvoice_OpenCashDeskRequest  $request
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
