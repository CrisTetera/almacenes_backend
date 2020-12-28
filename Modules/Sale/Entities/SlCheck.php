<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_bank_id
 * @property int $sl_customer_id
 * @property string $number
 * @property float $amount
 * @property string $place
 * @property string $date
 * @property boolean $flag_delete
 * @property GBank $gBank
 * @property SlCustomer $slCustomer
 */
class SlCheck extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sl_check';

    /**
     * @var array
     */
    protected $fillable = ['g_bank_id', 'sl_customer_id', 'number', 'amount', 'place', 'date', 'flag_delete'];



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
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }
}
