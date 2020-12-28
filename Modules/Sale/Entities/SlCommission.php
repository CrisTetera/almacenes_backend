<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $sl_commission_type_id
 * @property string $name
 * @property string $description
 * @property float $percentage
 * @property boolean $flag_delete
 */
class SlCommission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_commission';

    /**
     * @var array
     */
    protected $fillable = [
        'sl_commission_type_id',
        'name',
        'description',
        'percentage',
        'flag_delete',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slCommissionType()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCommissionType');
    }
}
