<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $pos_sale_payment_type_id
 * @property integer $pos_sale_id
 * @property integer $pos_payment_check_type_id
 * @property integer $g_bank_id
 * @property string $serial_number
 * @property integer $account_number
 * @property integer $plaza
 * @property integer $amount
 * @property string $emission_date
 * @property string $charge_date
 * @property boolean $flag_delete
 * @property PosSalePaymentType $posSalePaymentType
 */
class PosPaymentCheck extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_payment_check';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_sale_payment_type_id',
        'pos_sale_id',
        'pos_payment_check_type_id',
        'g_bank_id',
        'serial_number',
        'account_number',
        'plaza',
        'amount',
        'emission_date',
        'charge_date',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSalePaymentType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSalePaymentType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBank()
    {
        return $this->belongsTo('Modules\General\Entities\GBank');
    }

}
