<?php

namespace Modules\Pos\Services\PosSale;

use Illuminate\Http\Request;
use Modules\Pos\Entities\PosSale;
use Modules\Pos\Services\DTE\Entities\DTE\NotaCreditoBoleta;
use Modules\Pos\Services\DTE\Entities\DTE\NotaCreditoFactura;
use Modules\General\Entities\GCompany;
use Modules\General\Entities\GBranchOffice;
use Modules\Sale\Services\SlSaleInvoice\CrudSlSaleInvoiceService;
use Modules\Sale\Services\SlSaleTicket\CrudSlSaleTicketService;
// Exceptions
use GuzzleHttp\Exception\RequestException;
use Modules\Pos\Services\DTE\Exception\ValidateDTEFieldsException;
use Modules\Pos\Services\DTE\Exception\ResponseFromOFException;
use Modules\Pos\Services\DTE\Exception\SaveFileDteException;
// Save

use DB;


class DteGenerateCreditNoteService
{
    //Const
    private const ID_G_COMPANY = 1;

    private const SALE_TYPE_TICKET = 1;
    private const SALE_TYPE_INVOICE = 2;

    private const PATH_SAVE_DTE_FILES = 'app/public/DTE';

    private const ERROR_CODE_REQUEST_TO_API_OF = 1;
    private const ERROR_CODE_VALIDATIONS_FIELDS_DTE = 2;
    private const ERROR_CODE_RESPONSE_FROM_API_OF = 3;
    private const ERROR_CODE_SAVE_FILES_DTE_IN_LOCAL_STORAGE = 4;
    private const ERROR_CODE_SERVER = 5;

    private const CODE_IND_SERVICIO_FACTURA_SERVICIOS = 3;

    private const CODE_TIPO_TRANSACCION_VENTAS_GIRO = 1;

    private const CODE_FORMA_PAGO_CONTADO = 1;
    private const CODE_FORMA_PAGO_CREDITO = 2;

    private const IVA_RATE = 19;

    private const TYPE_MOVEMENT_DISCOUNT = 'D';

    private const REFERENCE_CODE_CANCEL_DOCUMENT = 1;
    private const REFERENCE_CODE_FIXED_TEXT_DOCUMENT = 2; // not used still
    private const REFERENCE_CODE_FIXED_AMOUNT_DOCUMENT = 3; // not used still

    // State DTE
    private const STATE_OPEN_POS_SALE = 17;
    private const STATE_CANCEL_POS_SALE = 18;
    private const STATE_PAYED_POS_SALE = 19;

    // Variables
    private $dte;
    private $posSale;

    public function generateCreditNote_OfSale($posSale)
    {
        try
        {
            $this->posSale = $posSale;
            
            // Check if error
            if(! $this->checkPoseSaleCanceled())
                throw new \Exception("Venta no ha sido anulada");
            
            if(!  $this->checkExistTicketOrInvoice())
                throw new \Exception("Venta no tiene una boleta o factura de venta asociada");

            $this->dte = $posSale->pos_sale_type_id === self::SALE_TYPE_TICKET ?
                         new NotaCreditoBoleta($posSale->slSaleTicket->document_token) :
                         new NotaCreditoFactura($posSale->slSaleInvoice->document_token);

            $this->createDTE_object();
            $this->requestDteToApiOF();
            $response = $this->saveFilesDTE();

            if($response['status'] === 'error')
                throw new \Exception("Error with DB.\n Error: "
                                    . $responseDB['error'] . "\n File: "
                                    . $responseDB['file'] . "\n Line: "
                                    . $responseDB['line'] . "\n DTE: "
                                    );
            
            return [
                'status' => 'success',
                'message' => 'El DTE fue creado exitosamente',
                'paths' => $response['paths'],
                'dte' => $this->dte,
            ];
        }
        catch(\Exception $e) //catch DTE Requets Exception to Open Factura
        {
            switch($e)
            {
                case $e instanceof RequestException:
                    $errorRequest = $e->getResponse()->getBody()->getContents();
                    $errorCode = self::ERROR_CODE_REQUEST_TO_API_OF;
                    $error = $errorRequest !== null ?
                                array_merge(
                                    array("error_request" => $errorRequest),
                                    array("json_dte_sended" => $this->dte->getJson())
                                ) :
                                $e->getMessage();
                    break;

                case $e instanceof ValidateDTEFieldsException:
                    $errorCode = self::ERROR_CODE_VALIDATIONS_FIELDS_DTE;
                    $error = $e->getMessage();
                    break;

                case $e instanceof ResponseFromOFException:
                    $errorCode = self::ERROR_CODE_RESPONSE_FROM_API_OF;
                    $error = $e->getMessage();
                    break;

                case $e instanceof SaveFileDteException:
                    $errorCode = self::ERROR_CODE_SAVE_FILES_DTE_IN_LOCAL_STORAGE;
                    $error = $e->getMessage();
                    break;
                default: // normal exception
                    $errorCode = self::ERROR_CODE_SERVER;
                    $error = $e->getMessage();
            }

            return([
                'status' => 'error',
                'message' => 'Ha ocurrido en el servidor',
                'error_code' => $errorCode,
                'error' => $error,
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stack_trace_error' => $e->getTraceAsString(),
            ]);
        }

    } // end function

    // FIXME: add comments
    private function checkPoseSaleCanceled()
    {
        if($this->posSale->g_state_id !== self::STATE_CANCEL_POS_SALE)
            return false;

        return true;
    } // end function

    // FIXME: add comments
    private function checkExistTicketOrInvoice()
    {
        if(! isset($this->posSale->slSaleTicket) && ! isset($this->posSale->slSaleInvoice))
            return false;
        
        return true;
    } // end function

    private function createDTE_object()
    {
        if($this->posSale->pos_sale_type_id === self::SALE_TYPE_TICKET)
            $this->createDTE_objectBoleta();
        else
            $this->createDTE_objectFactura();
    } // end function


    private function createDTE_objectBoleta()
    {
        $this->setEncabezadoDTE_Boleta();
        $this->setEmisorDTE();
        if($this->posSale->slCustomer !== null) $this->setReceptorDTE();

        $this->setTotalDTE_Boleta();
        $this->setDetalleDTE_Boleta();

        if($this->posSale->discount_or_charge_percentage)
            $this->setDescuentoRecargoGlobal();

        $this->setReferencia();
    } // end functio

    private function createDTE_objectFactura()
    {
        $this->setEncabezadoDTE_Factura();
        $this->setEmisorDTE();
        if($this->posSale->slCustomer !== null) $this->setReceptorDTE();

        $this->setTotalDTE_Factura();
        $this->setDetalleDTE_Factura();

        if($this->posSale->discount_or_charge_percentage)
            $this->setDescuentoRecargoGlobal();

        $this->setReferencia();
    } // end functio


    private function setEncabezadoDTE_Boleta()
    {
        $this->dte->setEncabezado(
            1, // Folio is ignore in open factura
            $this->posSale->saleCLoseDate(),
            $this->posSale->isAfecta()
        );
    } // end function

    private function setEncabezadoDTE_Factura()
    {
        $this->dte->setEncabezado(
            1, // Folio is ignore in open factura
            $this->posSale->saleCLoseDate(),
            $this->posSale->isAfecta(),
            self::CODE_TIPO_TRANSACCION_VENTAS_GIRO, // tipo tranasacción compra
            self::CODE_TIPO_TRANSACCION_VENTAS_GIRO, // tipo tranascción venta
            ( // forma de pago
                $this->posSale->isTypeInvoicePaymentCredit() ?
                self::CODE_FORMA_PAGO_CREDITO :
                self::CODE_FORMA_PAGO_CONTADO
            )        
        );
    } // end function

    private function setEmisorDTE()
    {
        $thisCompany = GCompany::find(self::ID_G_COMPANY);
        $branchOfficeSaleDone = GBranchOffice::find($this->posSale->g_branch_office_id);

        $this->dte->setEmisor(
            $thisCompany->rut,
            $thisCompany->business_name,
            $thisCompany->commercial_business,
            $thisCompany->commercial_activity_code,
            $thisCompany->address,  //FIXME: Add address branch office
            $thisCompany->gCommune->name, //FIXME: Add commune branch office
            $branchOfficeSaleDone->sii_barnch_office_sii
        ); //FIXME: Add code for sucursal
    } // end function

    private function setReceptorDTE()
    {
        $slCustomer = $this->posSale->slCustomer;
        $this->dte->setReceptor(
            $slCustomer->rut,
            $slCustomer->business_name,
            $slCustomer->core_business,
            $this->posSale->slCustomerBranchOffices->address,
            $this->posSale->slCustomerBranchOffices->gCommune->name
        );
    } // end function

    private function setTotalDTE_Boleta()
    {
        $this->dte->setTotales(
            $this->posSale->ticket_total
        );
    } // end function

    private function setTotalDTE_Factura()
    {
        $this->dte->setTotales(
            $this->posSale->new_net_subtotal,
            self::IVA_RATE,
            $this->posSale->iva,
            $this->posSale->invoice_total
        );
    } // end function

    private function setDetalleDTE_boleta()
    {
        foreach($this->posSale->posDetailSales()->orderBy('line_number', 'ASC')->get() as $index => $detailSale)
        {
            $this->dte->addLineaDetalle(
                $detailSale->whProduct->is_tax_free ? 1 : 0, // IndExe
                ($index + 1), // NroLinDte
                $detailSale->whProduct->name, // NmbItem
                $detailSale->quantity, // QtyItem
                $detailSale->price, // PrcItem
                $detailSale->total, // MontoItem
                $detailSale->discount_or_charge_percentage === 0 ? 0 : $detailSale->discountOrChargePercentage(), // DescuentoPct FIXME: Add percentage from DB
                $detailSale->discountOrChargeValue() // DescuentoPct FIXME: Add percentage from DB
            );
        } // end foreach
    } // end function

    private function setDetalleDTE_Factura()
    {
        foreach($this->posSale->posDetailSales()->orderBy('line_number', 'ASC')->get() as $index => $detailSale)
        {
            $this->dte->addLineaDetalle(
                $detailSale->whProduct->is_tax_free ? 1 : 0, // IndExe
                ($index + 1), // NroLinDte
                $detailSale->whProduct->name, // NmbItem
                $detailSale->quantity, // QtyItem
                $detailSale->net_price, // PrcItem
                $detailSale->new_net_subtotal, // MontoItem
                $detailSale->discount_or_charge_percentage === 0 ? 0 : $detailSale->discountOrChargePercentage(), // DescuentoPct FIXME: Add percentage from DB
                $detailSale->discountOrChargeValue() // DescuentoMonto FIXME: Add percentage from DB
            );
        } // end foreach
    } // end function

    private function setDescuentoRecargoGlobal()
    {
        $this->dte->setDescuentoRecargoGlobal(
            $this->posSale->discount_or_charge_percentage, 0, '%', self::TYPE_MOVEMENT_DISCOUNT
        ); //FIXME: Adjust 2nd param
    } // end function

    // FIXME: add comments
    private function setReferencia()
    {
        $dteToCancel = isset($this->posSale->slSaleTicket) ? 
                           $this->posSale->slSaleTicket : 
                           $this->posSale->slSaleInvoice;  
            
        $this->dte->setReferencia(
            $dteToCancel->dte_type_ticket ? $dteToCancel->dte_type_ticket : $dteToCancel->dte_type_invoice, // $tpoDocRef
            $dteToCancel->number, // $folioRef 
            $dteToCancel->emission_date, // $fchaRef 
            self::REFERENCE_CODE_CANCEL_DOCUMENT, // $codRef
            "Anula Documento Electrónico"
        );
    } // end function



    private function requestDteToApiOF() {
        return $this->dte->sendDte();
    } // end function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSale  $posSale
     * @return array
     */
    public function saveFilesDTE()
    {
        return $this->dte->saveFilesDte(
            storage_path(self::PATH_SAVE_DTE_FILES)
        );
    }

} // end class
