<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $sl_customer_id
 * @property int $g_bank_id
 * @property int $g_type_account_bank_id
 * @property string $number
 * @property string $rut
 * @property string $email
 * @property boolean $flag_delete
 * @property GBank $gBank
 * @property GTypeAccountBank $gTypeAccountBank
 * @property SlCustomer $slCustomer
 * @property SlElectronicTransferPayment[] $slElectronicTransferPayments
 */
class SlCustomerAccountBank extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_customer_account_bank';

    /**
     * @var array
     */
    protected $fillable = ['sl_customer_id', 'g_bank_id', 'g_type_account_bank_id', 'number', 'rut', 'email', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBank()
    {
        return $this->belongsTo('Modules\General\Entities\GBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gTypeAccountBank()
    {
        return $this->belongsTo('Modules\General\Entities\GTypeAccountBank');
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
    public function slElectronicTransferPayments()
    {
        return $this->hasMany('Modules\Sale\Entities\SlElectronicTransferPayment');
    }
}
