<?php

namespace Modules\Pos\Services\PosSalePos\Entities;

class DetailSaleData
{

    /**
     * Precio neto unitario
     *
     * @var float
     */
    private $MntExe;
    /**
     * ID de la bodega
     *
     * @var integer
     */
    private $warehouseId;

    /**
     * ID del producto
     *
     * @var integer
     */
    private $productId;

    /**
     * Cantidad
     *
     * @var integer
     */
    private $quantity;

    /**
     * Precio unitario
     *
     * @var integer
     */
    private $price;

    /**
     * Producto libre de impuestos
     *
     * @var boolean
     */
    private $isTaxFree;

    /**
     * Precio neto unitario
     *
     * @var float
     */
    private $netPrice;

    /**
     * Subtotal neto (precio neto * cantidad)
     *
     * @var integer
     */
    private $netSubtotal;

    /**
     * Descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @var integer
     */
    private $discountPercentage;

    /**
     * Descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @var integer
     */
    private $discountAmount;

    /**
     * Descuento o cargo en valor monetario (Total.) (Ej: $20 => 20)
     *
     * @var integer
     */
    private $discountValue;

    /**
     * Nuevo subtotal (después de aplicar descuentos)
     *
     * @var integer
     */
    private $newNetSubtotal;

    /**
     * Line Number Pos Sale (util for generate DTE)
     *
     * @var integer
     */
    private $lineNumber;

    /**
     * Constructor
     *
     * @param integer $quantity
     * @param integer $productId
     * @param integer $price
     * @param boolean $isTaxFree
     * @param integer $discountPercentage
     * @param integer $discountAmount
     */
    public function __construct($warehouseId, $productId, $quantity, $price, $isTaxFree, $discountPercentage, $discountAmount, $lineNumber = null)
    {
        $this->warehouseId = $warehouseId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->isTaxFree = $isTaxFree;
        $this->discountPercentage = $discountPercentage;
        $this->discountAmount = $discountAmount;
        $this->lineNumber = $lineNumber;
        $this->apply();
    }

    /**
     * Calculates detail sale data
     *
     * @return void
     */
    private function apply()
    {
        if ( !$this->isTaxFree ) { // Afecto
            $this->netPrice = round( $this->price / ( 1 + SaleConstant::IVA ), 2 );
        } else { // Exento
            $this->netPrice = $this->price;
            $MntExe = $this->MntExe + $this->netPrice;
        }
        $this->netSubtotal = (int) round( $this->netPrice * $this->quantity );
        $this->discountValue = (int) round($this->discountAmount,0);
        // Nota: No utilizo $this->netSubtotal, porque se pierden pesos al ya estar redondeado
        $amountPercentageDiscount = (int) round( $this->netPrice * $this->quantity * $this->discountPercentage / 100.0, 0);
        $amountLineDiscount = (int) round( $this->discountAmount/(1 + SaleConstant::IVA), 0 );
        $this->newNetSubtotal = $this->netSubtotal - $amountPercentageDiscount - $amountLineDiscount;
        $this->total = (int) round( $this->price * $this->quantity * ( 100 - $this->discountPercentage) / 100.0 ) - $this->discountValue;

    }


    /**
     * Get cantidad
     *
     * @return  integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set cantidad
     *
     * @param  integer  $quantity  Cantidad
     *
     * @return  self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get precio unitario
     *
     * @return  integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set precio unitario
     *
     * @param  integer  $price  Precio unitario
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get precio neto unitario
     *
     * @return  float
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * Set precio neto unitario
     *
     * @param  integer  $netPrice  Precio neto unitario
     *
     * @return  self
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;
        return $this;
    }

    /**
     * Get subtotal neto (precio neto cantidad)
     *
     * @return  integer
     */
    public function getNetSubtotal()
    {
        return $this->netSubtotal;
    }

    /**
     * Set subtotal neto (precio neto cantidad)
     *
     * @param  integer  $netSubtotal  Subtotal neto (precio neto cantidad)
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
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * Set descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @param  integer  $discountPercentage  Descuento o cargo en porcentaje (Ej: 10% => 10)
     *
     * @return  self
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    /**
     * Get descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @return  integer
     */
    public function getDiscountValue()
    {
        return $this->discountValue;
    }

    /**
     * Set descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @param  integer  $discountValue  Descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @return  self
     */
    public function setDiscountValue($discountValue)
    {
        $this->discountValue = $discountValue;
        return $this;
    }

    /**
     * Get nuevo subtotal (después de aplicar descuentos)
     *
     * @return  integer
     */
    public function getNewNetSubtotal()
    {
        return $this->newNetSubtotal;
    }

    /**
     * Set nuevo subtotal (después de aplicar descuentos)
     *
     * @param  integer  $newNetSubtotal  Nuevo subtotal (después de aplicar descuentos)
     *
     * @return  self
     */
    public function setNewNetSubtotal($newNetSubtotal)
    {
        $this->newNetSubtotal = $newNetSubtotal;
        return $this;
    }

    /**
     * Get total (IVA. Incl si es afecto)
     *
     * @return  integer
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set total (IVA. Incl si es afecto)
     *
     * @param  integer  $total  Total (IVA. Incl si es afecto)
     *
     * @return  self
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * Get producto libre de impuestos
     *
     * @return  boolean
     */
    public function getIsTaxFree()
    {
        return $this->isTaxFree;
    }

    /**
     * Set producto libre de impuestos
     *
     * @param  boolean  $isTaxFree  Producto libre de impuestos
     *
     * @return  self
     */
    public function setIsTaxFree(boolean $isTaxFree)
    {
        $this->isTaxFree = $isTaxFree;
        return $this;
    }


    /**
     * Get descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @return  integer
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Set descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @param  integer  $discountAmount Descuento o cargo en valor monetario (Ej: $20 => 20)
     *
     * @return  self
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * Get iD del producto
     *
     * @return  integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set iD del producto
     *
     * @param  integer  $productId  ID del producto
     *
     * @return  self
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * Get iD de la bodega
     *
     * @return  integer
     */
    public function getWarehouseId()
    {
        return $this->warehouseId;
    }

    /**
     * Set iD de la bodega
     *
     * @param  integer  $warehouseId  ID de la bodega
     *
     * @return  self
     */
    public function setWarehouseId($warehouseId)
    {
        $this->warehouseId = $warehouseId;

        return $this;
    }

    /**
     * Get line Number Pos Sale (util for generate DTE)
     *
     * @return  integer
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }
}
