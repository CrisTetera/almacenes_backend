<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property PosSalePosPaymentType[] $posSalePosPaymentTypes
 */
class PosSalePaymentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_sale_payment_type';

    /**
     * @var array
     */
    protected $fillable = ['type'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalePosPaymentTypes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePosPaymentType');
    }
}
