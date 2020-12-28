<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property PchProviderAccountMovement[] $pchProviderAccountMovements
 * @property PchProviderAccountMovement[] $pchProviderAccountMovements
 */
class PchTypeProviderAccountMovement extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_type_provider_account_movement';

    /**
     * @var array
     */
    protected $fillable = ['type'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchProviderAccountMovements()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchProviderAccountMovement');
    }

}
