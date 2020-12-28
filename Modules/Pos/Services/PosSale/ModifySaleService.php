<?php

namespace Modules\Pos\Services\PosSale;

use App\Http\Response\CustomResponse;
use Illuminate\Support\Facades\DB;
use Modules\Pos\Entities\PosSale;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Illuminate\Validation\ValidationException as LaravelValidationException;
use Illuminate\Http\Request;

class ModifySaleService
{

    /** @var CancelSaleService $cancelSaleService */
    private $cancelSaleService;
    /** @var GenerateSaleService $generateSaleService */
    private $generateSaleService;

    public function __construct(
        CancelSaleService $cancelSaleService,
        GenerateSaleService $generateSaleService
    )
    {
        $this->cancelSaleService = $cancelSaleService;
        $this->generateSaleService = $generateSaleService;
    }

    /**
     * Modify the sale
     *
     * $request structure:
     * [
     *   // Sale to modify:
     *   "sale_to_modify_id" => 1,
     *   // Se reciben los code del vendedor y del supervisor en caso de
     *   "seller_user_code" => 874,
     *   "supervisor_user_code" => null,
     *   // Solo si ya está, si no se envía null
     *   "customer_id" => 1,
     *   // Si no está se envía:
     *   'customer' => null,
     *   'sucursal_id' => 1,
     *   "pos_sale_type" => 1, //Ej: Boleta
     *   "global_discount" => 10, // En %
     *   "global_discount_amount" => 0, // En monto
     *   "total" => 252, // Para validar los campos
     *   "sale_detail" => [
     *       [
     *           "product_id" => 1,
     *           "quantity" => 1,
     *           "price" => 100,
     *           "discount" => 10, // En %
     *           'discount_unit_price' => 0, // En monto
     *           'wh_warehouse_id' => 1
     *       ],
     *       [
     *           "product_id" => 2,
     *           "quantity" => 1,
     *           "price" => 200,
     *           "discount" => 0,
     *           'discount_unit_price' => 10, // En monto
     *           'wh_warehouse_id' => 1
     *       ]
     *   ]
     * ];
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function modifySale(Request $request)
    {
        try {
            DB::beginTransaction();
            $sale = PosSale::where('id', $request->sale_to_modify_id)->first();
            if (!$sale) {
                throw new ValidationException("La venta no existe");
            }
            if ($sale->g_state_id !== SaleConstant::SALE_STATE_VALE_VENTA || $sale->flag_delete) {
                throw new ValidationException("No se puede modificar una venta anulada, completada o eliminada");
            }
            // Cancel Sale.
            $response = $this->cancelSaleService->cancelSale($request->sale_to_modify_id);
            $this->checkResponse($response);
            // Generate new Sale
            $response = $this->generateSaleService->store($request);
            $this->checkResponse($response);

            DB::commit();
            return $response;
        } catch(\Exception $e) {
            DB::rollback();
            if ($e instanceof LaravelValidationException) {
                return CustomResponse::error($e, [ 'errors' => $e->errors() ], 422);
            }
            return CustomResponse::error($e);
        }
    }

    /**
     * Check response, if not throws exception with error message
     *
     * @param array $response
     * @return void
     */
    public function checkResponse($response) {
        if ( $response['status'] !== 'success' ) {
            throw new \Exception($response['error']);
        }
    }


}
