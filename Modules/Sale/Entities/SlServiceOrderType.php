<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 */
class SlServiceOrderType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_service_order_type';

    /**
     * @var array
     */
    protected $fillable = [
        'type'
    ];

}
