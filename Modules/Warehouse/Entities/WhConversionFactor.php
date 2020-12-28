<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wh_unit_of_measurement_id
 * @property int $wh_unit_of_measurement_id2
 * @property float $conversion_factor
 * @property WhUnitOfMeasurement $whUnitOfMeasurementLeft
 * @property WhUnitOfMeasurement $whUnitOfMeasurementRight
 */
class WhConversionFactor extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_conversion_factor';

    /**
     * @var array
     */
    protected $fillable = ['wh_unit_of_measurement_id', 'wh_unit_of_measurement_id2', 'conversion_factor'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whUnitOfMeasurementLeft()
    {
        return $this->belongsTo('Modules\Warehouse\Entities\WhUnitOfMeasurement', 'wh_unit_of_measurement_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function whUnitOfMeasurementRight()
    {   
        return $this->belongsTo('Modules\Warehouse\Entities\WhUnitOfMeasurement', 'wh_unit_of_measurement_id2');
    }
}
