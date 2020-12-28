<?php

namespace Modules\Warehouse\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $unity_symbol
 * @property string $name
 * @property boolean $minimun_unit
 * @property boolean $flag_delete
 * @property WhConversionFactor[] $whConversionFactorsLeft
 * @property WhConversionFactor[] $whConversionFactorsRight
 * @property WhItem[] $whItems
 */
class WhUnitOfMeasurement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wh_unit_of_measurement';

    /**
     * @var array
     */
    protected $fillable = ['unity_symbol', 'name', 'minimun_unit', 'flag_delete'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whConversionFactorsLeft()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhConversionFactor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whConversionFactorsRight()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhConversionFactor', 'wh_unit_of_measurement_id2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whItems()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhItem');
    }
}
