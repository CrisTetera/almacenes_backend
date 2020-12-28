<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;

class PosSalePos extends Model
{
    //Constant
    private const POS_SALE_BOLETA = 1;
    private const POS_SALE_FACTURA = 2;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_sale_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_invoice_id',
        'sl_ticket_id',
        'pos_cash_desk_id',
        'g_cashier_id',
        'g_state_id',
        'close_sale_datetime',
        'pos_sale_type_id',
        //'pos_payment_method_id',
        'sl_customer_id',
        'net_subtotal',
		'global_discount_amount',
		'global_discount_percentage',
		'new_net_subtotal',
		'exempt_total',
		'iva',
        'ticket_total',
        'invoice_total',
        'rounding_law',
		'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSaleTypePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSaleTypePos','pos_sale_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailPos', 'pos_sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posPaymentMethodPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosPaymentMethodPos', 'pos_sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posTypePaymentMethodPos()
    {
        return $this->belongsToMany('Modules\Pos\Entities\PosTypePaymentMethodPos', 'pos_payment_method_pos', 'pos_sale_id', 'pos_type_payment_method_id')
                    ->withPivot('amount_payment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashDeskPos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashDeskPos' , 'pos_cash_desk_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posTrustSalePos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosTrustSalePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slTicketPos()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlTicketPos','sl_ticket_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slInvoicePos()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlInvoicePos','sl_invoice_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerPos()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPos' , 'sl_customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCashierPos()
    {
        return $this->belongsTo('Modules\General\Entities\GUserPos','g_cashier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gStatePos()
    {
        return $this->belongsTo('Modules\General\Entities\GStatePos' , 'g_state_id');
    }

    // FIXME: add comments
    public function saleCloseDatePos()
    {
        return date('Y-m-d', strtotime($this->close_sale_datetime));
    } // end function

    public function isInvoice()
    {
        return $this->pos_sale_type_id == SaleConstant::INVOICE;
    }
    
    public function isTrustSale()
    {
        return $this->pos_sale_type_id == SaleConstant::TRUST_SALE;
    }

    // FIXME: Add comments
    public function isAfecta()
    {
        return $this->ticket_total > $this->exent_total;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSaleStockReservationPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSaleStockReservationPos','pos_sale_id');
    }
    
    // FIXME: add comments
    public function getGlobalDiscountValue_WithPercentageDiscount()
    {
        if($this->pos_sale_type_id == self::POS_SALE_BOLETA)
            $posSaleSubtotal = $this->posDetailSales()
                                    ->where('flag_delete', false)
                                    ->get()
                                    ->pluck('total')
                                    ->sum();
        else // POS_SALE_FACTURA
            $posSaleSubtotal = $this->posDetailSales()
                                    ->where('flag_delete', false)
                                    ->get()
                                    ->pluck('new_net_subtotal')
                                    ->sum();

        return (int) round($posSaleSubtotal * $this->discount_percentage/100);
    } // end function

    // FIXME: add comments
    public function getGlobalDiscountValueAttribute()
    {
        if($this->pos_sale_type_id == self::POS_SALE_BOLETA)
            $posSaleSubtotal = $this->posDetailPos()
                                    ->where('flag_delete', false)
                                    ->get()
                                    ->pluck('total')
                                    ->sum();
        else // POS_SALE_FACTURA
            $posSaleSubtotal = $this->posDetailPos()
                                    ->where('flag_delete', false)
                                    ->get()
                                    ->pluck('new_net_subtotal')
                                    ->sum();

        return (int) round($posSaleSubtotal * $this->discount_percentage/100);
    } // end function

    /**
     * Return payments associated to a sale FIIIX IT YOU LITTLE BASTARD
     *
     * @return array
     */
    public function getPaymentsAttribute()
    {
        $posSalePosPaymentTypes = PosPaymentMethodPos::where('pos_payment_method_pos.pos_sale_id', $this->id)
                    ->join('pos_sale_payment_type', 'pos_sale_payment_type.id', 'pos_sale_pos_payment_type.pos_sale_payment_type_id')
                    ->get();
        // Se puede pagar varias veces con el mismo medio de pago
        // Cada pago encontrado se almacena en el arreglo $foundedId
        $foundedIds = [ 'check' => [0], 'voucher' => [0], 'cash' => [0], 'transfer' => [0] ];
        foreach( $posSalePosPaymentTypes as $i => $posSalePosPaymentType ) {
            if ( in_array( $posSalePosPaymentType['id'], [ SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO] ) ) {
                $posSalePosPaymentTypes[$i]['voucher'] = $this->getVoucher($posSalePosPaymentType['pos_sale_payment_type_id'], $foundedIds['voucher']);
                array_push($foundedIds['voucher'], $posSalePosPaymentTypes[$i]['voucher']['id']);
            } else if ( $posSalePosPaymentType['id'] === SaleConstant::PAYMENT_TYPE_EFECTIVO ) {
                $posSalePosPaymentTypes[$i]['cash'] = $this->getCash($posSalePosPaymentType['pos_sale_payment_type_id'], $foundedIds['cash']);
                array_push($foundedIds['cash'], $posSalePosPaymentTypes[$i]['cash']['id']);
            } 
        }
        return $posSalePosPaymentTypes;
    }
    // FIXME: add comments
    public function isTypeInvoicePaymentCredit()
    {
        $creditPaymentType = $this->posTypePaymentMethodPos()->where('pos_type_payment_method_pos.id', 1)->get();
        if(count($creditPaymentType) > 0)
            return true;

        return false;
    } // end function
}
