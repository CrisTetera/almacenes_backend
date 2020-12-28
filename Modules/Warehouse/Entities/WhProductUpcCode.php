<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $wh_product_id
 * @property string $upc_code
 * @property boolean $flag_delete
 */
class WhProductUpcCode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wh_product_upc_code';

    /**
     * @var array
     */
    protected $fillable = [
        'wh_product_id',
        'upc_code',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whProduct()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhProduct');
    }
}
