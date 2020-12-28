<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $reference
 * @property boolean $flag_delete
 */
class SlWholesaleRef extends Model
{
    public const PRODUCT    = 1;
    public const FAMILY     = 2;
    public const SUBFAMILY  = 3;
    public const NONE       = 4;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_wholesale_ref';

    /**
     * @var array
     */
    protected $fillable = [
        'reference',
        'flag_delete'
    ];
}
