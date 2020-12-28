<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pos_sale_payment_type_id
 * @property int $pos_sale_id
 * @property int $transfer_number
 * @property boolean $flag_delete
 * @property PosSalePaymentType $posSalePaymentType
 * @property PosSale $posSale
 */
class PosPaymentElectronicTransfer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_payment_electronic_transfer';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'pos_sale_payment_type_id',
        'pos_sale_id',
        'transfer_number',
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
    public function posSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSale');
    }
}
