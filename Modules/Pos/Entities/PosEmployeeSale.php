<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

/**
 * @property int $id
 * @property int $g_seller_user_id
 * @property int $g_cashier_user_id
 * @property int $g_supervisor_user_id
 * @property int $pos_cash_desk_id
 * @property int $g_state_id
 * @property int $g_branch_office_id
 * @property int $net_subtotal
 * @property int $discount_or_charge_percentage
 * @property int $discount_or_charge_amount
 * @property int $new_net_subtotal
 * @property int $exent_total
 * @property int $iva
 * @property int $ticket_total
 * @property int $invoice_total
 * @property int $close_sale_datetime
 * @property boolean $flag_delete
 * @property GUser $gSellerUser
 * @property PosCashDesk $posCashDesk
 * @property GState $gState
 * @property PosEmployeeSalePaymentType $posEmployeeSalePaymentType
 * @property GUser $gSupervisorUser
 * @property GUser $gCashierUser
 * @property GBranchOffice $gBranchOffice
 * @property PosDetailEmployeeSale[] $posDetailEmployeeSales
 * @property PosEmployeeSaleStockReservation[] $posEmployeeSaleStockReservations
 * @property PosManualDiscount $posManualDiscount
 */
class PosEmployeeSale extends Model
{

    // Constants
    private const POS_SALE_BOLETA = 1;
    private const POS_SALE_FACTURA = 2;

    /**
     * @var array
     */
    protected $appends = ['global_discount_value'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_employee_sale';

    /**
     * @var array
     */
    protected $fillable = [
        'g_seller_user_id',
        'g_supervisor_user_id',
        'g_cashier_user_id',
        'pos_cash_desk_id',
        'g_branch_office_id',
        'g_state_id',
        'sl_sale_ticket_id',
        'pos_sale_type_id',
        'net_subtotal',
        'discount_or_charge_percentage',
        'discount_or_charge_amount',
        'new_net_subtotal',
        'exent_total',
        'iva',
        'ticket_total',
        'invoice_total',
        'close_sale_datetime',
        'flag_delete'
    ];



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
    public function posCashDesk()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosCashDesk');
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
    public function gCashierUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_cashier_user_id');
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
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GUser', 'g_branch_office_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailEmployeeSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailEmployeeSale');
    }

    /**
     * FIX FOR GENERATING DTE
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDetailSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDetailEmployeeSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSaleStockReservations()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSaleStockReservation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paymentTypes()
    {
        return $this->belongsToMany('Modules\Pos\Entities\PosEmployeeSalePaymentType', 'pos_employee_sale_pos_employee_sale_payment_type', 'pos_employee_sale_id', 'pos_employee_sale_payment_type_id')
                    ->withPivot('amount');
    }

    /**
     * Return true if is afecta
     *
     * @return boolean
     */
    public function isAfecta()
    {
        return $this->ticket_total > $this->exent_total;
    }

    /**
     * Return close datetime formatted to Y-m-d
     *
     * @return void
     */
    public function saleCLoseDate()
    {
        return date('Y-m-d', strtotime($this->close_sale_datetime));
    } // end function

    /**
     * Return global discounts
     *
     * @return void
     */
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

        return (int) round($posSaleSubtotal * $this->discount_or_charge_percentage /100);
    }

    /**
     * Return global discounts
     *
     * @return void
     */
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

        return (int) round($posSaleSubtotal * $this->discount_or_charge_percentage /100);
    }


    /**
     * Return payments associated to employee sale
     *
     * @return array
     */
    public function getPaymentsAttribute()
    {
        $paymentTypes = PosEmployeePosEmployeeSalePaymentType::where('pos_employee_sale_pos_employee_sale_payment_type.pos_employee_sale_id', $this->id)
                    ->join('pos_employee_sale_payment_type', 'pos_employee_sale_payment_type.id', 'pos_employee_sale_pos_employee_sale_payment_type.pos_employee_sale_payment_type_id')
                    ->get();
        // Se puede pagar varias veces con el mismo medio de pago
        // Cada pago encontrado se almacena en el arreglo $foundedId
        $foundedIds = [ 'check' => [0], 'voucher' => [0], 'internal_credit' => [0], 'cash' => [0], 'transfer' => [0] ];
        foreach( $paymentTypes as $i => $paymentType ) {
            if ( $paymentType['id'] === SaleConstant::PAYMENT_TYPE_BANK_CHECK ) {
                $paymentTypes[$i]['bank_check'] = $this->getBankCheck($paymentType['pos_employee_sale_payment_type_id'], $foundedIds['check']);
                array_push($foundedIds['check'], $paymentTypes[$i]['bank_check']['id']);
            } else if ( in_array( $paymentType['id'], [ SaleConstant::PAYMENT_TYPE_DEBITO, SaleConstant::PAYMENT_TYPE_CREDITO] ) ) {
                $paymentTypes[$i]['voucher'] = $this->getVoucher($paymentType['pos_employee_sale_payment_type_id'], $foundedIds['voucher']);
                array_push($foundedIds['voucher'], $paymentTypes[$i]['voucher']['id']);
            } else if ( $paymentType['id'] === SaleConstant::PAYMENT_TYPE_INTERNAL_CREDIT ) {
                $paymentTypes[$i]['internal_credit'] = $this->getInternalCredit($paymentType['pos_employee_sale_payment_type_id'], $foundedIds['internal_credit']);
                array_push($foundedIds['internal_credit'], $paymentTypes[$i]['internal_credit']['id']);
            } else if ( $paymentType['id'] === SaleConstant::PAYMENT_TYPE_EFECTIVO ) {
                $paymentTypes[$i]['internal_credit'] = $this->getCash($paymentType['pos_employee_sale_payment_type_id'], $foundedIds['cash']);
                array_push($foundedIds['cash'], $paymentTypes[$i]['cash']['id']);
            } else if ( $paymentType['id'] === SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER ) {
                $paymentTypes[$i]['electronic'] = $this->getElectronicTransfer($paymentType['pos_employee_sale_payment_type_id'], $foundedIds['transfer']);
                array_push($foundedIds['transfer'], $paymentTypes[$i]['transfer']['id']);
            }
        }
        return $paymentTypes;
    }

    /**
     * Get Bank check data, not in founded ids
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getBankCheck($paymentTypeId, $foundedIds = [])
    {
        return PosEmployeePaymentCheck::with('gBank')
                                    ->where('pos_employee_sale_id', $this->id)
                                    ->where('pos_employee_sale_payment_type_id', $paymentTypeId)
                                    ->join('pos_payment_check_type', 'pos_employee_payment_check.pos_payment_check_type_id', 'pos_payment_check_type.id')
                                    ->whereNotIn('pos_employee_payment_check.id', $foundedIds)
                                    ->selectRaw('pos_employee_payment_check.*')
                                    ->orderBy('pos_employee_payment_check.id', 'desc')
                                    ->first();
    }

    /**
     * Get Voucher data, not in founded ids
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getVoucher($paymentTypeId, $foundedIds = [])
    {
        return PosEmployeePaymentVoucher::where('pos_employee_sale_id', $this->id)
                                        ->where('pos_employee_sale_payment_type_id', $paymentTypeId)
                                        ->whereNotIn('pos_employee_payment_voucher.id', $foundedIds)
                                        ->orderBy('pos_employee_payment_voucher.id', 'desc')
                                        ->first();
    }

    /**
     * Get Internal Credit data, not in founded ids
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getInternalCredit($paymentTypeId, $foundedIds = [])
    {
        return PosEmployeeInternalCredit::where('pos_employee_sale_id', $this->id)
                                    ->where('pos_employee_sale_payment_type_id', $paymentTypeId)
                                    ->whereNotIn('pos_employee_internal_credit.id', $foundedIds)
                                    ->orderBy('pos_employee_internal_credit.id', 'desc')
                                    ->first();
    }

    /**
     * Get Cash data, not in founded ids
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getCash($paymentTypeId, $foundedIds = [])
    {
        return PosEmployeePaymentCash::where('pos_employee_sale_id', $this->id)
                                        ->where('pos_employee_sale_payment_type_id', $paymentTypeId)
                                        ->whereNotIn('pos_employee_payment_cash.id', $foundedIds)
                                        ->orderBy('pos_employee_payment_cash.id', 'desc')
                                        ->first();
    }

    /**
     * Get Electronic Transfer data, not in founded ids
     *
     * @param integer $paymentTypeId
     * @param array $foundedIds
     * @return void
     */
    public function getElectronicTransfer($paymentTypeId, $foundedIds = [])
    {
        return PosEmployeePaymentElectronicTransfer::where('pos_employee_sale_id', $this->id)
                                        ->where('pos_employee_sale_payment_type_id', $paymentTypeId)
                                        ->whereNotIn('pos_employee_payment_electronic_transfer.id', $foundedIds)
                                        ->orderBy('pos_employee_payment_electronic_transfer.id', 'desc')
                                        ->first();
    }

}
