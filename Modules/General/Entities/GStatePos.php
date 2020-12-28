<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

class GStatePos extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'g_state_pos';

    protected $fillable = [
        'g_state_type_id',
        'state',
        'flag_delete'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gStateTypePos()
    {
        return $this->belongsTo('Modules\General\Entities\GStateTypePos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashesPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCashPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function whInventoryPos()
    {
        return $this->hasMany('Modules\Warehouse\Entities\WhInventoryPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posCashDeskPos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashDeskPos');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSalePos()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSalePos');
    }
}
