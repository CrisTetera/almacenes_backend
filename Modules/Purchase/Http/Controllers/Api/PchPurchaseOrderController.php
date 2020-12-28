<?php

namespace Modules\Purchase\Http\Controllers\Api;

use Spatie\QueryBuilder\QueryBuilder;
use Modules\Purchase\Entities\PchPurchaseOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\Filter;
use Modules\Purchase\Http\Requests\PchPurchaseOrder\CreatePurchaseOrderRequest;
use Illuminate\Support\Facades\DB;
use Modules\Purchase\Services\PchPurchaseOrder\PurchaseOrderService;
use App\Http\Response\CustomResponse;
use Modules\Purchase\Http\Requests\PchPurchaseOrder\EditPurchaseOrderRequest;
use Modules\Purchase\Services\PchPurchaseOrder\GeneratePDFPurchaseOrderService;
use Modules\Purchase\Services\PchPurchaseOrder\AuthorizePurchaseOrderService;

class PchPurchaseOrderController extends Controller
{

    /** @var PurchaseOrderService $purchaseOrderService */
    private $purchaseOrderService;
    /** @var GeneratePDFPurchaseOrderService $generatePDFPurchaseOrderService */
    private $generatePDFPurchaseOrderService;
    /** @var AuthorizePurchaseOrderService $authorizePurchaseOrderService */
    private $authorizePurchaseOrderService;

    public function __construct(
        PurchaseOrderService $purchaseOrderService,
        GeneratePDFPurchaseOrderService $generatePDFPurchaseOrderService,
        AuthorizePurchaseOrderService $authorizePurchaseOrderService
    )
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->generatePDFPurchaseOrderService = $generatePDFPurchaseOrderService;
        $this->authorizePurchaseOrderService = $authorizePurchaseOrderService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $query =  QueryBuilder::for(PchPurchaseOrder::orderBy('id'))
                                ->allowedIncludes(
                                    'pch_provider',
                                    'pch_provider_branch_offices',
                                    'pch_payment_condition',
                                    'pch_purchase_order_state',
                                    'wh_warehouse.g_branch_office.g_commune',
                                    'g_originator_user.hr_employee',
                                    'g_authorizer_user.hr_employee',
                                    'pch_detail_purchase_orders.wh_product',
                                    'wh_orderers.pch_provider',
                                    'wh_orderers.pch_provider_branch_offices',
                                    'wh_orderers.wh_warehouse',
                                    'wh_orderers.g_supervisor_user',
                                    'wh_product_receptions'
                                )
                                ->allowedFilters([
                                    Filter::exact('pch_provider_id'),
                                    Filter::exact('pch_provider_branch_offices_id'),
                                    Filter::exact('pch_payment_condition_id'),
                                    Filter::exact('pch_purchase_order_state_id'),
                                    Filter::exact('wh_warehouse_id'),
                                    Filter::exact('g_originator_user_id'),
                                    Filter::exact('g_authorizer_user_id'),
                                ])
                                ->where('flag_delete', 0);

        if($request->get_all_results)
        {
            $response['data'] = $query->get();
            return $response;
        }
        else
            return $query->paginate($request->limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePurchaseOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePurchaseOrderRequest $request)
    {
        $response = DB::transaction(function() use (&$request) {
            $resp = $this->purchaseOrderService->store($request);
            return CustomResponse::created(['purchase_order_id' => $resp ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Authorize Purchase Order
     *
     * @param int $idPchPurchaseOrder
     * @return JsonResponse
     */
    public function authorizePurchaseOrder(int $idPchPurchaseOrder)
    {
        $response = DB::transaction(function() use ($idPchPurchaseOrder) {
            $this->authorizePurchaseOrderService->authorize($idPchPurchaseOrder);
            return CustomResponse::ok(['message' => 'Orden de Compra autorizada con éxito.' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int $idPchPurchaseOrder
    * @return \Illuminate\Http\Response
    */
    public function show($idPchPurchaseOrder)
    {
        return QueryBuilder::for(PchPurchaseOrder::where('id', $idPchPurchaseOrder))
                            ->allowedIncludes(
                                'pch_provider',
                                'pch_provider_branch_offices',
                                'pch_payment_condition',
                                'pch_purchase_order_state',
                                'wh_warehouse.g_branch_office.g_commune',
                                'g_originator_user.hr_employee',
                                'g_authorizer_user.hr_employee',
                                'pch_detail_purchase_orders.wh_product',
                                'wh_orderers.pch_provider',
                                'wh_orderers.pch_provider_branch_offices',
                                'wh_orderers.g_branch_office',
                                'wh_orderers.g_supervisor_user',
                                'wh_product_receptions'
                            )
                            ->where('flag_delete', 0)
                            ->first();
    }

    /**
     * Generates PDF
     *
     * @param integer $idPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($idPurchaseOrder)
    {
        return $this->generatePDFPurchaseOrderService->streamPDF($idPurchaseOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditPurchaseOrderRequest  $request
     * @param  int  $idPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(EditPurchaseOrderRequest $request, int $idPurchaseOrder)
    {
        $response = DB::transaction(function() use (&$request, $idPurchaseOrder) {
            $this->purchaseOrderService->update($idPurchaseOrder, $request);
            return CustomResponse::ok(['message' => 'Orden de Compra actualizada con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $idPurchaseOrder)
    {
        $response = DB::transaction(function() use ($idPurchaseOrder) {
            $this->purchaseOrderService->delete($idPurchaseOrder);
            return CustomResponse::ok(['message' => 'Orden de Compra eliminada con éxito' ]);
        });
        return response()->json($response, $response['http_status_code']);
    }
}
