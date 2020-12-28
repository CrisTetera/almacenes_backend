<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $pos_sale_id
 * @property integer $purchase_order
 * @property boolean $flag_delete
 * @property PosSale $posSale
 */
class PosSaleInvoiceData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_sale_invoice_data';

    /**
     * @var array
     */
    protected $fillable = [
        'pos_sale_id',
        'purchase_order',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posSale()
    {
        return $this->belongsTo('Modules\Pos\Entities\PosSale');
    }

}
