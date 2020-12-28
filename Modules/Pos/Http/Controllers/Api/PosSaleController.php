<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Services\PosSale\GenerateSaleService;
use Modules\Pos\Services\PosSale\DtePosSaleService;
use Modules\Pos\Services\PosSale\PayPosSaleService;
use Modules\Pos\Services\PosSale\CancelSaleService;
use Modules\Pos\Services\PosSale\ModifySaleService;
use Illuminate\Support\Facades\DB;
use App\Http\Response\CustomResponse;

class PosSaleController extends Controller
{

    /** @var GenerateSaleService $generateSaleService */
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
        $query =  QueryBuilder::for(PosSale::orderBy('id'))
                            ->allowedIncludes(
                                'pos_customer_credit_option',
                                'pos_sale_type',
                                'g_seller_user.hr_employee',
                                'g_supervisor_user.hr_employee',
                                'g_cashier_user.hr_employee',
                                'g_branch_office',
                                'pos_cash_desk',
                                'pos_manual_discount',
                                'wh_sale_note',
                                'sl_customer',
                                'sl_customer_branch_offices.g_commune',
                                'pos_sale_note',
                                'pos_sale_pos_payment_types.pos_sale_payment_type',
                                'pos_detail_sales.wh_product',
                                'pos_detail_sales.wh_warehouse',
                                'g_state',
                                'sl_sale_ticket',
                                'sl_sale_invoice'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_customer_credit_option_id'),
                                Filter::exact('pos_sale_type_id'),
                                Filter::exact('g_seller_user_id'),
                                Filter::exact('g_supervisor_user_id'),
                                Filter::exact('g_cashier_user_id'),
                                Filter::exact('g_branch_office_id'),
                                Filter::exact('pos_cash_desk_id'),
                                Filter::exact('pos_manual_discount_id'),
                                Filter::exact('wh_sale_note_id'),
                                Filter::exact('sl_customer_id'),
                                Filter::exact('pos_sale_note_id'),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paySale(Request $request)
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
        return QueryBuilder::for(PosSale::where('id', $idPosSale))
                            ->allowedIncludes(
                                'pos_customer_credit_option',
                                'pos_sale_type',
                                'g_seller_user',
                                'g_supervisor_user',
                                'g_cashier_user',
                                'g_branch_office',
                                'pos_cash_desk',
                                'pos_manual_discount',
                                'wh_sale_note',
                                'sl_customer',
                                'sl_customer_branch_offices.g_commune',
                                'pos_sale_note',
                                'pos_detail_sales.wh_product',
                                'pos_detail_sales.wh_warehouse',
                                'pos_sale_pos_payment_types.pos_sale_payment_type',
                                'g_state',
                                'sl_sale_ticket',
                                'sl_sale_invoice'
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
     */
    public function destroy($id)
    {
        $response = $this->cancelSaleService->cancelSale($id);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }
}
