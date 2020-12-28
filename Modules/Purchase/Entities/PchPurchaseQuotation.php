<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $pch_provider_id
 * @property int $pch_provider_id2
 * @property int $g_state_id
 * @property string $description
 * @property boolean $flag_delete
 * @property PchProvider $pchProvider
 * @property GState $gState
 * @property PchProvider $pchProvider
 * @property PchDetailPurchaseQuotation[] $pchDetailPurchaseQuotations
 */
class PchPurchaseQuotation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pch_purchase_quotation';

    /**
     * @var array
     */
    protected $fillable = ['pch_provider_id', 'pch_provider_id2', 'g_state_id', 'description', 'flag_delete'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pchProvider()
    {
        return $this->belongsTo('Modules\Purchase\Entities\PchProvider');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gState()
    {
        return $this->belongsTo('Modules\General\Entities\GState');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pchDetailPurchaseQuotations()
    {
        return $this->hasMany('Modules\Purchase\Entities\PchDetailPurchaseQuotation');
    }
}
