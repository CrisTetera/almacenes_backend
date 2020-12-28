<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pos_sale_payment_type_id
 * @property int $pos_sale_id
 * @property int $amount
 * @property PosSale $posSale
 * @property PosSalePaymentType $posSalePaymentType
 */
class PosSalePosPaymentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_sale_pos_payment_type';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_sale_id',
        'pos_sale_payment_type_id',
        'amount'
     ];


    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSalePaymentType()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSalePaymentType');
    }

}
