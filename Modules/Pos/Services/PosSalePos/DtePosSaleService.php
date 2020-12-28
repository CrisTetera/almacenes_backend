<?php

namespace Modules\Pos\Services\PosSalePos;

use Illuminate\Http\Request;
use Modules\Pos\Entities\PosSalePos;
use Modules\Pos\Services\DTEPos\Entities\DTE\Factura;
use Modules\Pos\Services\DTEPos\Entities\DTE\Boleta;
use Modules\General\Entities\GCompanyPos;
use Modules\Sale\Services\SlSaleInvoicePos\CrudSlSaleInvoiceService;
use Modules\Sale\Services\SlSaleTicketPos\CrudSlSaleTicketService;
// Exceptions
use GuzzleHttp\Exception\RequestException;
use Modules\Pos\Services\DTEPos\Exception\ValidateDTEFieldsException;
use Modules\Pos\Services\DTEPos\Exception\ResponseFromOFException;
use Modules\Pos\Services\DTEPos\Exception\SaveFileDteException;
// Save

use DB;


class DtePosSaleService
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


    // Variables
    private $dte;
    private $posSale;

    public function generateAndSaveDTE($posSale)
    {
        try
        {
            $this->posSale = $posSale;
            $this->dte = $posSale->pos_sale_type_id === self::SALE_TYPE_TICKET ?
                         new Boleta() :
                         new Factura();
            $this->createDTE_object();
            $this->requestDteToApiOF();

            $response = $this->saveFilesDTE();

            
            $responseDB = $this->dte instanceof Boleta  ? $this->saveSlSaleTicketInDB($response['paths']) :
                                                          $this->saveSaleInvoiceInDB($response['paths']);

            if($responseDB['status'] === 'error')
                throw new \Exception("Error with DB.\n Error: "
                                    . $responseDB['error'] . "\n File: "
                                    . $responseDB['file'] . "\n Line: "
                                    . $responseDB['line'] . "\n DTE: "
                                    );

            return [
                'status' => 'success',
                'message' => 'El DTE fue creado y registrado exitosamente',
                'dte' => $responseDB['dte'],
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
            ]);
        }

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
        if($this->posSale->slCustomerPos !== null) $this->setReceptorDTE();

        $this->setTotalDTE_Boleta();
        $this->setDetalleDTE_Boleta();

        if($this->posSale->global_discount_percentage)
            $this->setDescuentoRecargoGlobal();
    } // end functio

    private function createDTE_objectFactura()
    {
        $this->setEncabezadoDTE_Factura();
        $this->setEmisorDTE();
        if($this->posSale->slCustomerPos !== null) $this->setReceptorDTE();

        $this->setTotalDTE_Factura();
        $this->setDetalleDTE_Factura();

        if($this->posSale->discount_or_charge_percentage)
            $this->setDescuentoRecargoGlobal();
        $this->setReferenciaOC();
    } // end functio


    private function setEncabezadoDTE_Boleta()
    {
        $this->dte->setEncabezado(
            1, // Folio is ignore in open factura
            $this->posSale->saleCloseDatePos(),
            $this->posSale->isAfecta(),
            self::CODE_IND_SERVICIO_FACTURA_SERVICIOS
        );
    } // end function

    private function setEncabezadoDTE_Factura()
    {
        $this->dte->setEncabezado(
            1, // Folio is ignore in open factura
            $this->posSale->saleCloseDatePos(),
            $this->posSale->isAfecta(),
            self::CODE_TIPO_TRANSACCION_VENTAS_GIRO, // tipo tranasacción compra
            self::CODE_TIPO_TRANSACCION_VENTAS_GIRO, // tipo tranascción venta
            ( // forma de pago
                $this->posSale->isTypeInvoicePaymentCredit() ?
                self::CODE_FORMA_PAGO_CREDITO :
                self::CODE_FORMA_PAGO_CONTADO
            ),
            self::CODE_IND_SERVICIO_FACTURA_SERVICIOS
        );
    } // end function

    private function setEmisorDTE()
    {
        $thisCompany = GCompanyPos::find(self::ID_G_COMPANY);
        // $branchOfficeSaleDone = GBranchOffice::find($this->posSale->g_branch_office_id);

        $this->dte->setEmisor(
            $thisCompany->rut,
            $thisCompany->business_name,
            $thisCompany->commercial_business,
            $thisCompany->commercial_activity_code,
            $thisCompany->address,  //FIXME: Add address branch office
            $thisCompany->gCommunePos->name, //FIXME: Add commune branch office
            $thisCompany->sii_branch_office_sii
        ); //FIXME: Add code for sucursal
    } // end function

    private function setReceptorDTE()
    {
        $slCustomer = $this->posSale->slCustomerPos;
        // $slCustomerBranchOffice = $this->posSale->slCustomerBranchOffices;
        $this->dte->setReceptor(
            $slCustomer->rut,
            $slCustomer->business_name,
            $slCustomer->commercial_business,
            $slCustomer->address,
            $slCustomer->gCommunePos->name
        );
    } // end function

    private function setTotalDTE_Boleta()
    {
        $this->dte->setTotales(
            $this->posSale->exempt_total,
            $this->posSale->ticket_total
        );
    } // end function

    private function setTotalDTE_Factura()
    {
        $this->dte->setTotales(
            $this->posSale->exempt_total,
            $this->posSale->new_net_subtotal,
            self::IVA_RATE,
            $this->posSale->iva,
            $this->posSale->invoice_total
        );
    } // end function

    private function setDetalleDTE_boleta()
    {
        foreach($this->posSale->posDetailPos()->orderBy('line_number', 'ASC')->get() as $index => $detailSale)
        {
            $this->dte->addLineaDetalle(
                $detailSale->whProductPos->is_tax_free ? 1 : 0, // IndExe
                ($index + 1), // NroLinDte
                $detailSale->whProductPos->name, // NmbItem
                $detailSale->quantity, // QtyItem
                $detailSale->price, // PrcItem
                $detailSale->total, // MontoItem
                $detailSale->discount_percentage === 0 ? 0 : $detailSale->discountPercentage(), // DescuentoPct FIXME: Add percentage from DB
                $detailSale->discountAmount() // DescuentoPct FIXME: Add percentage from DB
            );
        } // end foreach
    } // end function

    private function setDetalleDTE_Factura()
    {
        foreach($this->posSale->posDetailPos()->orderBy('line_number', 'ASC')->get() as $index => $detailSale)
        {
            $this->dte->addLineaDetalle(
                $detailSale->whProductPos->is_tax_free ? 1 : 0, // IndExe
                ($index + 1), // NroLinDte
                $detailSale->whProductPos->name, // NmbItem
                $detailSale->quantity, // QtyItem
                $detailSale->net_price, // PrcItem
                $detailSale->new_net_subtotal, // MontoItem
                $detailSale->discount_percentage === 0 ? 0 : $detailSale->discountPercentage(), // DescuentoPct FIXME: Add percentage from DB
                $detailSale->discountAmount() // DescuentoMonto FIXME: Add percentage from DB
            );
        } // end foreach
    } // end function

    private function setDescuentoRecargoGlobal()
    {
        $this->dte->setDescuentoRecargoGlobal(
            $this->posSale->global_discount_percentage, 0, '%', self::TYPE_MOVEMENT_DISCOUNT
        ); //FIXME: Adjust 2nd param
    } // end function

    private function setReferenciaOC()
    {
        $slCustomer = $this->posSale->slCustomerPos;
        $this->dte->setReferenciaOC(123456,$slCustomer->rut, date('Y-m-d'));
    } // end function



    private function requestDteToApiOF() {
        return $this->dte->sendDte();
    } // end functio

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Modules\Pos\PosSalePos  $posSale
     * @return array
     */
    public function saveFilesDTE()
    {
        return $this->dte->saveFilesDte(
            storage_path(self::PATH_SAVE_DTE_FILES)
        );
    }

    // FIXME: add comments
    private function saveSlSaleTicketInDB(array $paths)
    {
        $crudSlTicketService = new CrudSlSaleTicketService($this->posSale, $this->dte, $paths);
        return $crudSlTicketService->store();
    } // end function

    // FIXME: add comments
    private function saveSaleInvoiceInDB(array $paths)
    {
        $crudSlInvoiceService = new CrudSlSaleInvoiceService($this->posSale, $this->dte, $paths);
        return $crudSlInvoiceService->store();
    } // end function

} // end class
