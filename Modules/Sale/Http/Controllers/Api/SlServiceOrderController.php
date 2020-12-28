<?php

namespace Modules\Sale\Http\Controllers\Api;

use Modules\Sale\Entities\SlServiceOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Sale\Services\SlServiceOrder\ChangeServiceOrderService;
use Modules\Sale\Http\Requests\SlServiceOrder\ChangeServiceOrderRequest;
use Modules\Sale\Services\SlServiceOrder\CancelServiceOrderService;
use Modules\Sale\Http\Requests\SlServiceOrder\CancelServiceOrderRequest;

class SlServiceOrderController extends Controller
{

    /** @var ChangeServiceOrderService $changeServiceOrderService */
    private $changeServiceOrderService;
    /** @var CancelServiceOrderService $cancelServiceOrderService */
    private $cancelServiceOrderService;

    public function __construct(
        ChangeServiceOrderService $changeServiceOrderService,
        CancelServiceOrderService $cancelServiceOrderService
    )
    {
        $this->changeServiceOrderService = $changeServiceOrderService;
        $this->cancelServiceOrderService = $cancelServiceOrderService;
    }


    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(SlServiceOrder::orderBy('id'))
                        ->allowedIncludes(
                            'sl_sale_invoice_affected',
                            'sl_sale_invoice_new',
                            'sl_sale_ticket_affected',
                            'sl_sale_ticket_new',
                            'sl_sale_credit_note',
                            'sl_service_order_type'
                        )
                        ->allowedFilters(
                            Filter::exact('sl_sale_invoice_id'),
                            Filter::exact('sl_sale_invoice_id2'),
                            Filter::exact('sl_sale_ticket_id2'),
                            Filter::exact('sl_sale_ticket_id2'),
                            Filter::exact('sl_sale_credit_note_id2'),
                            Filter::exact('sl_service_order_type_id'),
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
     * Change products from a ticker or invoice.
     *
     * @param  Modules\Sale\Http\Requests\SlServiceOrder\ChangeServiceOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function change(ChangeServiceOrderRequest $request)
    {
        $response = $this->changeServiceOrderService->store($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Cancel ticket or invoice (you can cancel one or all products).
     *
     * @param  Modules\Sale\Http\Requests\SlServiceOrder\CancelServiceOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(CancelServiceOrderRequest $request)
    {
        $response = $this->cancelServiceOrderService->store($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idSlServiceOrder)
    {
        return QueryBuilder::for(SlServiceOrder::where('id', $idSlServiceOrder))
                        ->allowedIncludes(
                            'sl_sale_invoice_affected',
                            'sl_sale_invoice_new',
                            'sl_sale_ticket_affected',
                            'sl_sale_ticket_new',
                            'sl_sale_credit_note',
                            'sl_service_order_type'
                        )->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Sale\Entities\SlServiceOrder  $slServiceOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SlServiceOrder $slServiceOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Sale\Entities\SlServiceOrder  $slServiceOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlServiceOrder $slServiceOrder)
    {
        //
    }
}
