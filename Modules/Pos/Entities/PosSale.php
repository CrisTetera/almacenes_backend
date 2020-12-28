<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

/**
 * @property int $id
 * @property int $pos_customer_credit_option_id
 * @property int $pos_sale_type_id
 * @property int $g_seller_user_id
 * @property int $g_supervisor_user_id
 * @property int $g_cashier_user_id
 * @property int $g_user_id
 * @property int $g_branch_office_id
 * @property int $g_state_id
 * @property int $pos_cash_desk_id
 * @property int $pos_manual_discount_id
 * @property int $wh_sale_note_id
 * @property int $sl_customer_id
 * @property int $sl_customer_branch_offices_id
 * @property int $pos_sale_note_id
 * @property int $pos_origin_sale_id
 * @property integer $subtotal
 * @property integer $discount_or_charge_amount
 * @property integer $discount_or_charge_percentage
 * @property integer $new_subtotal
 * @property integer $iva
 * @property integer $total
 * @property integer $exent_total
 * @property boolean $flag_delete
 * @property PosCustomerCreditOption $posCustomerCreditOption
 * @property PosCashDesk $posCashDesk
 * @property GUser $gUser
 * @property GState $gState
 * @property GBranchOffice $gBranchOffice
 * @property PosSaleNote $posSaleNote
 * @property PosManualDiscount $posManualDiscount
 * @property PosSaleType $posSaleType
 * @property SlCustomerBranchOffices $slCustomerBranchOffice
 * @property SlCustomer $slCustomer
 * @property WhSaleNote $whSaleNote
 * @property PosSaleNote[] $posSaleNotes
 * @property PosDetailSale[] $posDetailSales
 * @property PosSalePosPaymentType[] $posSalePosPaymentTypes
 * @property WhSaleNote[] $whSaleNotes
 */
class PosSale extends Model
{
    // Consatant
    private const POS_SALE_BOLETA = 1;
    private const POS_SALE_FACTURA = 2;

    /**
     * @var array
     */
    protected $appends = ['global_discount_value', 'formatted_id', 'invoice_data'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_sale';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_customer_credit_option_id',
        'pos_sale_type_id',
        'g_seller_user_id',
        'g_supervisor_user_id',
        'g_cashier_user_id',
        'g_state_id',
        'g_branch_office_id',
        'pos_cash_desk_id',
        'pos_manual_discount_id',
        'wh_sale_note_id',
        'sl_customer_id',
        'sl_customer_branch_offices_id',
        'pos_sale_note_id',
        'net_subtotal',
        'discount_or_charge_amount',
        'discount_or_charge_percentage',
        'new_net_subtotal',
        'exent_total',
        'iva',
        'ticket_total',
        'invoice_total',
        'close_sale_datetime',
        'pos_origin_sale_id',
        'flag_delete'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCustomerCreditOption()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCustomerCreditOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posCashDesk()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashDesk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gSellerUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_seller_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gSupervisorUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_supervisor_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCashierUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_cashier_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gState()
    {
        return $this->belongsTo('Modules\General\Entities\GState');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSaleNote()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSaleNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posManualDiscount()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosManualDiscount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSaleType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSaleType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posOriginSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosOriginSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerBranchOffices()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerBranchOffices');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whSaleNote()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhSaleNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSaleNotes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSaleNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalePosPaymentTypes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePosPaymentType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paymentTypes()
    {
        return $this->belongsToMany('Modules\Pos\Entities\PosSalePaymentType', 'pos_sale_pos_payment_type', 'pos_sale_id', 'pos_sale_payment_type_id')
                    ->withPivot('amount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleTicket()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleTicket');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slSaleInvoice()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlSaleInvoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSaleInvoiceData()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSaleInvoiceData', 'id', 'pos_sale_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whSaleNotes()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhSaleNote');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSaleStockReservations()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSaleStockReservation');
    }

    public function isInvoice()
    {
        return $this->pos_sale_type_id == SaleConstant::INVOICE;
    }

    // FIXME: Add comments
    public function isAfecta()
    {
        return $this->ticket_total > $this->exent_total;
    }

    // FIXME: add comments
    public function saleCLoseDate()
    {
        return date('Y-m-d', strtotime($this->close_sale_datetime));
    } // end function

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

        return (int) round($posSaleSubtotal * $this->discount_or_charge_percentage/100);
    } // end function

    // FIXME: add comments
    public function getGlobalDiscountValueAttribute()
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

        return (int) round($posSaleSubtotal * $this->discount_or_charge_percentage/100);
    } // end function

    /**
     * Return payments associated to a sale
     *
     * @return array
     */
    public function getFormattedIdAttribute()
    {
        return SaleConstant::PREFIX_SALE_NORMAL.str_pad("$this->id", 12, '0', STR_PAD_LEFT);
    }

    /**
     * Return invoice data
     *
     * @return void
     */
    public function getInvoiceDataAttribute()
    {
        return PosSaleInvoiceData::where('pos_sale_id', $this->id)->where('flag_delete', 0)->first();
    }

    /**
     * Return payments associated to a sale
     *
     * @return array
     */
    public function getPaymentsAttribute()
    {
        $posSalePosPaymentTypes = PosSalePosPaymentType::where('pos_sale_pos_payment_type.pos_sale_id', $this->id)
                    ->join('pos_sale_payment_type', 'pos_sale_payment_type.id', 'pos_sale_pos_payment_type.pos_sale_payment_type_id')
                    ->get();
        // Se puede pagar varias veces con el mismo medio de pago
        // Cada pago encontrado se almacena en el arreglo $foundedId
        $foundedIds = [ 'check' => [0], 'voucher' => [0], 'cash' => [0], 'transfer' => [0] ];
        foreach( $posSalePosPaymentTypes as $i => $posSalePosPaymentType ) {
            if ( $posSalePosPaymentType['id'] === SaleConstant::PAYMENT_TYPE_BANK_CHECK ) {
                $posSalePosPaymentTypes[$i]['bank_check'] = $this->getBankCheck($posSalePosPaymentType['pos_sale_payment_type_id'], $foundedIds['check']);
                array_push($foundedIds['check'], $posSalePosPaymentTypes[$i]['bank_check']['id']);
            } else if ( in_array( $posSalePosPaymentType['id'], [ SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO] ) ) {
                $posSalePosPaymentTypes[$i]['voucher'] = $this->getVoucher($posSalePosPaymentType['pos_sale_payment_type_id'], $foundedIds['voucher']);
                array_push($foundedIds['voucher'], $posSalePosPaymentTypes[$i]['voucher']['id']);
            } else if ( $posSalePosPaymentType['id'] === SaleConstant::PAYMENT_TYPE_EFECTIVO ) {
                $posSalePosPaymentTypes[$i]['cash'] = $this->getCash($posSalePosPaymentType['pos_sale_payment_type_id'], $foundedIds['cash']);
                array_push($foundedIds['cash'], $posSalePosPaymentTypes[$i]['cash']['id']);
            } else if ( $posSalePosPaymentType['id'] === SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER ) {
                $posSalePosPaymentTypes[$i]['transfer'] = $this->getElectronicTransfer($posSalePosPaymentType['pos_sale_payment_type_id'], $foundedIds['transfer']);
                array_push($foundedIds['transfer'], $posSalePosPaymentTypes[$i]['transfer']['id']);
            }
        }
        return $posSalePosPaymentTypes;
    }

    /**
     * Return bank check data for a payment not in $foundedIds array
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getBankCheck($paymentTypeId, $foundedIds = [])
    {
        return  PosPaymentCheck::with('gBank')
                                ->where('pos_sale_id', $this->id)
                                ->where('pos_sale_payment_type_id', $paymentTypeId)
                                ->join('pos_payment_check_type', 'pos_payment_check.pos_payment_check_type_id', 'pos_payment_check_type.id')
                                ->whereNotIn('pos_payment_check.id', $foundedIds)
                                ->selectRaw('pos_payment_check.*')
                                ->orderBy('pos_payment_check.id', 'desc')
                                ->first();
    }

    /**
     * Return voucher data for a payment not in $foundedIds array
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getVoucher($paymentTypeId, $foundedIds = [])
    {
        return  PosPaymentVoucher::where('pos_sale_id', $this->id)
                            ->where('pos_sale_payment_type_id', $paymentTypeId)
                            ->whereNotIn('pos_payment_voucher.id', $foundedIds)
                            ->orderBy('pos_payment_voucher.id', 'desc')
                            ->first();
    }

    /**
     * Return cash for a payment not in $foundedIds array
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getCash($paymentTypeId, $foundedIds = [])
    {
        return  PosPaymentCash::where('pos_sale_id', $this->id)
                            ->where('pos_sale_payment_type_id', $paymentTypeId)
                            ->whereNotIn('pos_payment_cash.id', $foundedIds)
                            ->orderBy('pos_payment_cash.id', 'desc')
                            ->first();
    }

    /**
     * Return cash for a payment not in $foundedIds array
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getElectronicTransfer($paymentTypeId, $foundedIds = [])
    {
        return  PosPaymentElectronicTransfer::where('pos_sale_id', $this->id)
                            ->where('pos_sale_payment_type_id', $paymentTypeId)
                            ->whereNotIn('pos_payment_electronic_transfer.id', $foundedIds)
                            ->orderBy('pos_payment_electronic_transfer.id', 'desc')
                            ->first();
    }

    // FIXME: add comments
    public function isTypeInvoicePaymentCredit()
    {
        $creditPaymentType = $this->paymentTypes()->where('pos_sale_payment_type.id', SaleConstant::PAYMENT_TYPE_CUSTOMER_CREDIT)->get();
        if(count($creditPaymentType) > 0)
            return true;

        return false;
    } // end function


}
