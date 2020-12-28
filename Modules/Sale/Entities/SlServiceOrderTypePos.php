<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

class SlServiceOrderTypePos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_service_order_type_pos';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function slServiceOrder()
    {
        return $this->hasMany('Modules\Sale\Entities\SlServiceOrderPos');
    }
}
