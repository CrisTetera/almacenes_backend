<?php

namespace Modules\Pos\Services\PosSale;

use Modules\General\Entities\GBranchOffice;
use Modules\Sale\Entities\SlCustomer;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Pos\Entities\PosCashDesk;
use Modules\Pos\Entities\PosSalePaymentType;
use Dotenv\Exception\ValidationException;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\PosSale\Entities\SaleData;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\Sale\Entities\SlDetailListPrice;

class CheckPosSaleService {


    /**
     * Check if sale has products
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function checkSaleHasProducts($request) {
        $ok = $request->sale_detail && is_array($request->sale_detail) && count($request->sale_detail);
        if (!$ok) {
            throw new ValidationException("La venta debe contener al menos un producto");
        }
    }

    /**
     * Check if payment type exists.
     * If not, throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param integer $paymentTypeId
     * @return void
     */
    public function checkPaymentType($paymentTypeId) {
        PosSalePaymentType::findOrFail($paymentTypeId);
    }

    /**
     * Check if total exents is equal to sended exents.
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param array $details [total and tax_free]
     * @param integer $exentTotal
     * @return void
     */
    public function checkExents($details, $exentTotal) {
        $exent = 0;
        foreach( $details as $detail ) {
            if ($detail['tax_free']) {
                $exent += $detail['total'];
            }
        }
        if ($exent != $exentTotal) {
            throw new ValidationException("El exento calculado ($exent) no coincide con el exento enviado ($exentTotal)");
        }
    }


    /**
     * Check if price has a list price.
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param integer $product
     * @param integer $gBranchOfficeId
     * @return void
     */
    public function checkProductPrice($productId, $gBranchOfficeId) {
        $detailListPrice = SlDetailListPrice::where('wh_product_id', $productId)
                          ->join('sl_list_price', 'sl_list_price.id', 'sl_detail_list_price.sl_list_price_id')
                          ->where('sl_list_price.is_active', true)
                          ->where('sl_list_price.flag_delete', false)
                          ->where('sl_detail_list_price.flag_delete', false)
                          ->first();
        if (!$detailListPrice) {
            throw new ValidationException("No existe una lista de precios para el producto de ID '$productId'");
        }
    }

    /**
     * Check if product is salable.
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param Modules\Warehouse\Entities\WhProduct $product
     * @return void
     */
    public function checkProductIsSalable($product) {
        if (!$product->is_salable || $product->flag_delete) {
            throw new ValidationException("El producto '$product->name' no está marcado para la venta");
        }
    }

    /**
     * Check if customer exists.
     * If not, throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param integer $customerId
     * @return void
     */
    public function checkCustomer($customerId) {
        if ($customerId != null) {
            SlCustomer::findOrFail($customerId);
        }
    }

    /**
     * Check if sale type exists.
     * If not, throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param integer posSaleTypeId
     * @return void
     */
    public function checkPosSaleType($posSaleTypeId) {
        $ok = in_array($posSaleTypeId, [SaleConstant::TICKET, SaleConstant::INVOICE]);
        if (!$ok) {
            throw new ModelNotFoundException('Debe enviar Boleta o Factura');
        }
    }

    /**
     * Check if customerId is related with invoice,
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param integer $customerId
     * @param integer $saleTypeId
     * @return void
     */
    public function checkIfCustomerRelatedWithInvoice($customerId, $saleTypeId) {
        $ok = ($customerId && $saleTypeId == SaleConstant::INVOICE) ||
              ($saleTypeId == SaleConstant::TICKET);
        if (!$ok) {
            throw new ValidationException("Debe asociar un cliente a una factura");
        }
    }

    /**
     * Check if branch office exists.
     * If not, throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param integer gBranchOfficeId
     * @return void
     */
    public function checkBranchOffice($gBranchOfficeId) {
        GBranchOffice::findOrFail($gBranchOfficeId);
    }

    /**
     * Check if cash desk exists.
     * If not, throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param integer posCashDeskId
     * @return void
     */
    public function checkPosCashDesk($posCashDeskId) {
        PosCashDesk::findOrFail($posCashDeskId);
    }

    /**
     * Check if sended sale total is equals to calculated total,
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param Modules\Pos\Services\PosSale\Entities\SaleData $saleData
     * @return void
     */
    public function checkTotals(SaleData $saleData, $total) {
        $totalVenta = ($saleData->getPosSaleTypeId() === SaleConstant::TICKET) ? $saleData->getTicketTotal() : $saleData->getInvoiceTotal();
        if ($total !== $totalVenta) {
            throw new ValidationException("El total de la venta ($totalVenta) no corresponde al total enviado ($total).");
        }
    }


    /**
     * Check if sale total is equals than payment total,
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param PosSale $sale
     * @param integer $paymentTotal
     * @return void
     */
    public function checkPaymentTotals($sale, $paymentTotal) {
        $totalVenta = $sale->pos_sale_type_id === SaleConstant::TICKET ? $sale->ticket_total : $sale->invoice_total;
        if ($totalVenta !== $paymentTotal) {
            throw new ValidationException("El total de la venta ($totalVenta) no corresponde al total del monto pagado ($paymentTotal).");
        }
    }

    /**
     * Check if you can pay sale,
     * If not, throws Dotenv\Exception\ValidationException
     *
     * @param PosSale $posSale
     * @return void
     */
    public function checkCanPaySale(PosSale $posSale) {
        if ($posSale->flag_delete === true) {
            throw new ValidationException("La venta está eliminada.");
        }
        if ($posSale->g_state_id === SaleConstant::SALE_STATE_ANULADA) {
            throw new ValidationException("La venta está anulada.");
        }
        if ($posSale->g_state_id === SaleConstant::SALE_STATE_REALIZADA) {
            throw new ValidationException("La venta ya ha sido pagada.");
        }
    }

}
