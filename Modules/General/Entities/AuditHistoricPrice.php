<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $g_user_id
 * @property int $sl_list_price_id
 * @property string $init_datetime
 * @property string $finish_datetime
 * @property GUser $gUser
 * @property SlListPrice $slListPrice
 * @property WhProduct $whProduct
 */
class AuditHistoricPrice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'audit_historic_price';

    /**
     * @var array
     */
    protected $fillable = ['wh_product_id', 'g_user_id', 'sl_list_price_id', 'init_datetime', 'finish_datetime'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gUser()
    {
        return $this->belongsTo('Modules\General\Entities\GUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slListPrice()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlListPrice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
