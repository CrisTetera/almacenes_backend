<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $credit_option
 * @property boolean $flag_delete
 * @property PosSale[] $posSales
 */
class PosCustomerCreditOption extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_customer_credit_option';

    /**
     * @var array
     */
    protected $fillable = ['credit_option', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSale');
    }
}
