<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_branch_office_id
 * @property string $name
 * @property string $description
 * @property boolean $is_active
 * @property GBranchOffice $gBranchOffice
 * @property AuditHistoricPrice[] $auditHistoricPrices
 * @property SlDetailListPrice[] $slDetailListPrices
 */
class SlListPrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_list_price';

    /**
     * @var array
     */
    protected $fillable = [
        'g_branch_office_id',
        'name',
        'description',
        'is_active',
        'flag_delete'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gBranchOffice()
    {
        return $this->belongsTo('Modules\General\Entities\GBranchOffice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auditHistoricPrices()
    {
        return $this->hasMany('Modules\Sale\Entities\AuditHistoricPrice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slDetailListPrices()
    {
        return $this->hasMany('Modules\Sale\Entities\SlDetailListPrice');
    }
}
