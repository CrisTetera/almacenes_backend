<?php

namespace Modules\Pos\Http\Controllers\Api;

use Modules\Pos\Entities\PosEmployeeSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filter;
use Modules\Pos\Services\PosEmployeeSale\GenerateEmployeeSaleService;
use Modules\Pos\Services\PosEmployeeSale\PayPosEmployeeSaleService;

class PosEmployeeSaleController extends Controller
{

    /** @var GenerateEmployeeSaleService $generateEmployeeSaleService */
    private $generateEmployeeSaleService;

    /** @var PayPosEmployeeSaleService $payPosEmployeeSaleService */
    private $payPosEmployeeSaleService;

    public function __construct(
        GenerateEmployeeSaleService $generateEmployeeSaleService,
        PayPosEmployeeSaleService $payPosEmployeeSaleService
    )
    {
        $this->generateEmployeeSaleService = $generateEmployeeSaleService;
        $this->payPosEmployeeSaleService = $payPosEmployeeSaleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PosEmployeeSale::orderBy('id'))
                            ->allowedIncludes(
                                'pos_employee_sale_payment_type',
                                'g_seller_user',
                                'g_cashier_user',
                                'g_supervisor_user',
                                'pos_cash_desk',
                                'g_state',
                                'g_branch_office',
                                'pos_detail_employee_sales.wh_product',
                                'pos_employee_sale_stock_reservations'
                            )
                            ->allowedFilters(
                                Filter::exact('pos_employee_sale_payment_type_id'),
                                Filter::exact('g_seller_user_id'),
                                Filter::exact('g_cashier_user_id'),
                                Filter::exact('g_supervisor_user_id'),
                                Filter::exact('pos_cash_desk_id'),
                                Filter::exact('g_state_id'),
                                Filter::exact('g_branch_office_id'),
                                Filter::exact('pos_manual_discount_id')
                            )
                            ->allowedAppends('payments')
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
        $response = $this->generateEmployeeSaleService->store($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 201);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Pay the employee sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payEmployeeSale(Request $request)
    {
        $response = $this->payPosEmployeeSaleService->payEmployeeSale($request);
        if ($response['status'] === 'success') {
            return response()->json($response, 200);
        }
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idPosEmployeeSale)
    {
        return QueryBuilder::for(PosEmployeeSale::where('id', $idPosEmployeeSale))
                            ->allowedIncludes(
                                'pos_employee_sale_payment_type',
                                'g_seller_user',
                                'g_cashier_user',
                                'g_supervisor_user',
                                'pos_cash_desk',
                                'g_state',
                                'g_branch_office',
                                'pos_detail_employee_sales.wh_product',
                                'pos_employee_sale_stock_reservations'
                            )
                            ->allowedAppends('payments')
                            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosEmployeeSale  $posEmployeeSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosEmployeeSale $posEmployeeSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Pos\PosEmployeeSale  $posEmployeeSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosEmployeeSale $posEmployeeSale)
    {
        //
    }
}
