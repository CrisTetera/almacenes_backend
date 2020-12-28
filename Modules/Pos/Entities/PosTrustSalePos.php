<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

class PosTrustSalePos extends Model
{
    protected $fillable = [
        'pos_payment_method_id',
        'pos_sale_id',
        'sl_customer_id',
        'flag_is_payed',
        'flag_delete'
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
    public function slCustomerPos()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomerPos','sl_customer_id');
    }

    // Completar el método
    public function getPosDetailPosAttribute()
    {

    }

}
