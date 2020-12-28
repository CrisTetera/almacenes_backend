<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosSalePos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Services\PosSalePos\GenerateSaleService;
use Modules\Pos\Services\PosSalePos\DtePosSaleService;
use Modules\Pos\Services\PosSalePos\PayPosSaleService;
use Modules\Pos\Services\PosSalePos\CancelSaleService;
use Modules\Pos\Services\PosSalePos\ModifySaleService;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;
use Modules\Pos\Http\Requests\Pos\PaySaleRequest;


class PosSalePosController extends Controller
{
    /**  @var GenerateSaleService $generateSaleService */
    private $generateSaleService;
    /** @var PayPosSaleService $payPosSaleService */
    private $payPosSaleService;
    /** @var CancelSaleService $cancelSaleService */
    private $cancelSaleService;
    /** @var ModifySaleService $modifySaleService */
    private $modifySaleService;

    /**
     * Constructor
     *
     * @param GenerateSaleService $generateSaleService
     * @param PayPosSaleService $payPosSaleService
     * @param CancelSaleService $cancelSaleService
     * @param ModifySaleService $modifySaleService
     */
    function __construct(GenerateSaleService $generateSaleService,
                         PayPosSaleService $payPosSaleService,
                         CancelSaleService $cancelSaleService,
                         ModifySaleService $modifySaleService)
    {
        $this->generateSaleService = $generateSaleService;
        $this->payPosSaleService = $payPosSaleService;
        $this->cancelSaleService = $cancelSaleService;
        $this->modifySaleService = $modifySaleService;
    }

    /** 
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosSalePos::orderBy('id'))
                            ->allowedIncludes(
                                'pos_sale_type_pos',
                                'g_cashier_pos.hr_employee_pos',
                                'pos_cash_desk_pos',
                                'pos_sale_stock_reservation_pos',
                                'sl_customer_pos',
                                'pos_detail_pos.wh_product_pos',
                                'pos_detail_pos.wh_warehouse_pos',
                                'pos_payment_method_pos.pos_type_payment_method_pos',
                                'g_state_pos',
                                'sl_ticket_pos',
                                'sl_invoice_pos'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_sale_type_id'),
                                Filter::exact('g_cashier_id'),
                                Filter::exact('pos_cash_desk_id'),
                                Filter::exact('sl_customer_id'),
                                Filter::exact('g_state_id')
                            )
                            ->allowedAppends('payments', 'formatted_id')
                            ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        return $query->paginate($request->limit);
    }

    /** 
     * Store a newly sale (vale venta)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->generateSaleService->store($request);
            return CustomResponse::created($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Pay the sale
     *
     * @param  Modules\Pos\Http\Requests\Pos\PaySaleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function paySale(PaySaleRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->payPosSaleService->paySale($request);
            return CustomResponse::ok($resp);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /** 
     * Modify the sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modifySale(Request $request)
    {
        $response = $this->modifySaleService->modifySale($request);
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
    public function show($idPosSale)
    {
        return QueryBuilder::for(PosSalePos::where('id', $idPosSale))
                            ->allowedIncludes(
                                'pos_sale_type_pos',
                                'g_cashier_pos.hr_employee_pos',
                                'pos_cash_desk_pos',
                                'sl_customer_pos',
                                'pos_detail_pos.wh_product_pos',
                                'pos_detail_pos.wh_warehouse_pos',
                                'pos_payment_method_pos.pos_type_payment_method_pos',
                                'g_state_pos',
                                'sl_ticket_pos',
                                'sl_invoice_pos'
                            )
                            ->allowedAppends('payments', 'formatted_id')
                            ->first();
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSale  $posSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSale $posSale)
    {
        //
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     **/
    public function destroy($id)
    {
        $response = $this->cancelSaleService->cancelSale($id);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }
}
