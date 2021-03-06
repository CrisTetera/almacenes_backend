<?php

namespace Modules\Pos\Services\PosSale\Entities;

class SaleData
{

    /**
     * ID de la sucursal
     *
     * @var integer
     */
    private $branchOfficeId;

    /**
     * ID del cliente
     *
     * @var integer
     */
    private $customerId;

    /**
     * ID del Tipo de Venta (Boleta o Factura)
     *
     * @var integer
     */
    private $posSaleTypeId;

    /**
     * Total de los detalles (Suma de todos los totales de los detalles de venta)
     *
     * @var integer
     */
    private $detailTotals;

    /**
     * Subtotal Neto (Suma de nuevos subtotales netos de los detalles de venta)
     *
     * @var integer
     */
    private $netSubtotal;

    /**
     * Descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @var integer
     */
    private $discountOrChargePercentage;

    /**
     * Descuento o cargo en monto, diferente al de porcentage (No es la conversión)
     *
     * @var integer
     */
    private $discountOrChargeAmount;

    /**
     * Nuevo subtotal Neto
     *
     * @var integer
     */
    private $newNetSubtotal;

    /**
     * Total exento
     *
     * @var integer
     */
    private $exentTotal;

    /**
     * IVA
     *
     * @var integer
     */
    private $iva;

    /**
     * Total Boleta
     *
     * @var integer
     */
    private $ticketTotal;

    /**
     * Total Factura
     *
     * @var integer
     */
    private $invoiceTotal;

    /**
     * Detalles de la venta
     *
     * @var DetailSaleData[]
     */
    private $detailSaleData;

    /**
     * Constructor
     *
     * @param integer $branchOfficeId
     * @param integer $customerId
     * @param integer $posSaleTypeId
     * @param integer $globalDiscount
     * @param integer $globalDiscountAmount
     */
    public function __construct($branchOfficeId, $customerId, $posSaleTypeId, $globalDiscount, $globalDiscountAmount = 0)
    {
        $this->branchOfficeId = $branchOfficeId;
        $this->customerId = $customerId;
        $this->posSaleTypeId = $posSaleTypeId;
        $this->netSubtotal = 0;
        $this->discountOrChargePercentage = $globalDiscount;
        $this->discountOrChargeAmount = $globalDiscountAmount;
        $this->newNetSubtotal = 0;
        $this->exentTotal = 0;
        $this->iva = 0;
        $this->ticketTotal = 0;
        $this->invoiceTotal = 0;
        $this->detailSaleData = [];
    }

    /**
     * Attach a new detail sale data
     *
     * @param integer $warehouseId
     * @param integer $productId
     * @param integer $quantity
     * @param integer $price
     * @param boolean $isTaxFree
     * @param integer $discountPercentage
     * @param integer $discountUnitPrice
     * @return void
     */
    public function attachDetailSaleData($warehouseId, $productId, $quantity, $price, $isTaxFree, $discountPercentage, $discountUnitPrice, $lineNumber = null)
    {
        $detailSaleData = new DetailSaleData($warehouseId, $productId, $quantity, $price, $isTaxFree, $discountPercentage, $discountUnitPrice, $lineNumber);
        array_push( $this->detailSaleData, $detailSaleData );
    }

    /**
     * Calculates Sale Data in base of DetailSaleData
     *
     * @return void
     */
    public function apply()
    {
        foreach( $this->detailSaleData as $detail )
        {
            $this->detailTotals += $detail->getTotal();
            if ( !$detail->getIsTaxFree() ) { // Afecto
                $this->netSubtotal += $detail->getNewNetSubtotal();
            } else { // Exento
                $this->exentTotal += $detail->getNewNetSubtotal();
            }
        }

        $this->newNetSubtotal = (int) round( $this->netSubtotal * ( 100 - $this->discountOrChargePercentage ) / 100.0 - $this->discountOrChargeAmount / 1.19 );
        $this->iva = (int) round( $this->newNetSubtotal * SaleConstant::IVA );
        $this->ticketTotal = (int) round( $this->detailTotals * ( 100 - $this->discountOrChargePercentage ) / 100.0 - $this->discountOrChargeAmount );
        $this->invoiceTotal = $this->newNetSubtotal + $this->iva + $this->exentTotal;
    }

    /**
     * Get subtotal Neto
     *
     * @return  integer
     */
    public function getNetSubtotal()
    {
        return $this->netSubtotal;
    }

    /**
     * Set subtotal Neto
     *
     * @param  integer  $netSubtotal  Subtotal Neto
     *
     * @return  self
     */
    public function setNetSubtotal($netSubtotal)
    {
        $this->netSubtotal = $netSubtotal;
        return $this;
    }

    /**
     * Get descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @return  integer
     */
    public function getDiscountOrChargePercentage()
    {
        return $this->discountOrChargePercentage !== null ? $this->discountOrChargePercentage : 0;
    }

    /**
     * Set descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @param  integer  $discountOrChargePercentage  Descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @return  self
     */
    public function setDiscountOrChargePercentage($discountOrChargePercentage)
    {
        $this->discountOrChargePercentage = $discountOrChargePercentage;
        return $this;
    }

    /**
     * Get descuento o cargo en monto
     *
     * @return  integer
     */
    public function getDiscountOrChargeAmount()
    {
        return $this->discountOrChargeAmount !== null ? $this->discountOrChargeAmount : 0;
    }

    /**
     * Set descuento o cargo en monto
     *
     * @param  integer  $discountOrChargeAmount  Descuento o cargo en monto
     *
     * @return  self
     */
    public function setDiscountOrChargeAmount($discountOrChargeAmount)
    {
        $this->discountOrChargeAmount = $discountOrChargeAmount;
        return $this;
    }

    /**
     * Get nuevo subtotal Neto
     *
     * @return  integer
     */
    public function getNewNetSubtotal()
    {
        return $this->newNetSubtotal;
    }

    /**
     * Set nuevo subtotal Neto
     *
     * @param  integer  $newNetSubtotal  Nuevo subtotal Neto
     *
     * @return  self
     */
    public function setNewNetSubtotal($newNetSubtotal)
    {
        $this->newNetSubtotal = $newNetSubtotal;
        return $this;
    }

    /**
     * Get total exento
     *
     * @return  integer
     */
    public function getExentTotal()
    {
        return $this->exentTotal;
    }

    /**
     * Set total exento
     *
     * @param  integer  $exentTotal  Total exento
     *
     * @return  self
     */
    public function setExentTotal($exentTotal)
    {
        $this->exentTotal = $exentTotal;
        return $this;
    }

    /**
     * Get iVA
     *
     * @return  integer
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set iVA
     *
     * @param  integer  $iva  IVA
     *
     * @return  self
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
        return $this;
    }

    /**
     * Get total Boleta
     *
     * @return  integer
     */
    public function getTicketTotal()
    {
        return $this->ticketTotal;
    }

    /**
     * Set total Boleta
     *
     * @param  integer  $ticketTotal  Total Boleta
     *
     * @return  self
     */
    public function setTicketTotal($ticketTotal)
    {
        $this->ticketTotal = $ticketTotal;
        return $this;
    }

    /**
     * Get total Factura
     *
     * @return  integer
     */
    public function getInvoiceTotal()
    {
        return $this->invoiceTotal;
    }

    /**
     * Set total Factura
     *
     * @param  integer  $invoiceTotal  Total Factura
     *
     * @return  self
     */
    public function setInvoiceTotal($invoiceTotal)
    {
        $this->invoiceTotal = $invoiceTotal;
        return $this;
    }

    /**
     * Get total de los detalles (Suma de todos los totales de los detalles de venta)
     *
     * @return  integer
     */
    public function getDetailTotals()
    {
        return $this->detailTotals;
    }

    /**
     * Set total de los detalles (Suma de todos los totales de los detalles de venta)
     *
     * @param  integer  $detailTotals  Total de los detalles (Suma de todos los totales de los detalles de venta)
     *
     * @return  self
     */
    public function setDetailTotals($detailTotals)
    {
        $this->detailTotals = $detailTotals;

        return $this;
    }

    /**
     * Get iD de la sucursal
     *
     * @return  integer
     */
    public function getBranchOfficeId()
    {
        return $this->branchOfficeId;
    }

    /**
     * Set iD de la sucursal
     *
     * @param  integer  $branchOfficeId  ID de la sucursal
     *
     * @return  self
     */
    public function setBranchOfficeId($branchOfficeId)
    {
        $this->branchOfficeId = $branchOfficeId;
        return $this;
    }

    /**
     * Get iD del cliente
     *
     * @return  integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set iD del cliente
     *
     * @param  integer  $customerId  ID del cliente
     *
     * @return  self
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * Get iD del Tipo de Venta (Boleta o Factura)
     *
     * @return  integer
     */
    public function getPosSaleTypeId()
    {
        return $this->posSaleTypeId;
    }

    /**
     * Set iD del Tipo de Venta (Boleta o Factura)
     *
     * @param  integer  $posSaleTypeId  ID del Tipo de Venta (Boleta o Factura)
     *
     * @return  self
     */
    public function setPosSaleTypeId($posSaleTypeId)
    {
        $this->posSaleTypeId = $posSaleTypeId;
        return $this;
    }

    /**
     * Get detalles de la venta
     *
     * @return DetailSaleData[]
     */
    public function getDetailSaleData()
    {
        return $this->detailSaleData;
    }
}
