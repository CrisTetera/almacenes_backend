<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosPaymentMethodPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_payment_method_pos';

    protected $fillable = [
        'pos_sale_id',
        'pos_type_payment_method_id',
        'amount_payment',
        'rounding_law',
        'transfer_number'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSalePos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSalePos','pos_sale_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posTypePaymentMethodPos()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosTypePaymentMethodPos','pos_type_payment_method_id');
    }
}
