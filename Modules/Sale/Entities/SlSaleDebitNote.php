<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $sl_customer_account_movement_id
 * @property int $sl_customer_id
 * @property float $id
 * @property string $number
 * @property string $emission_date
 * @property float $subtotal
 * @property float $discount_or_charge
 * @property float $new_subtotal
 * @property float $iva
 * @property float $total
 * @property boolean $flag_delete
 * @property SlCustomerAccountMovement $slCustomerAccountMovement
 * @property SlCustomer $slCustomer
 * @property SlCustomerAccountMovement[] $slCustomerAccountMovements
 * @property SlDetailSaleDebitNote[] $slDetailSaleDebitNotes
 */
class SlSaleDebitNote extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_sale_debit_note';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_account_movement_id', 'sl_customer_id', 'id', 'number', 'emission_date', 'subtotal', 'discount_or_charge', 'new_subtotal', 'iva', 'total', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomerAccountMovement()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slCustomerAccountMovements()
    {
        return $this->hasMany('Modules\Sale\Entities\SlCustomerAccountMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailSaleDebitNotes()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailSaleDebitNote');
    }
}
