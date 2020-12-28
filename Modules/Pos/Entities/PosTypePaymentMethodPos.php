<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosTypePaymentMethodPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_type_payment_method_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posPaymentMethodPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosPaymentMethodPos','pos_payment_method_id');
    }
}
