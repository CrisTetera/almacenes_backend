<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $pch_provider_id
 * @property integer $g_commune_id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property boolean $default_branch_office
 * @property boolean $flag_delete
 * @property PchProvider $pchProvider
 * @property GCommune $gCommune
 */
class PchProviderBranchOffices extends Model
{
    public const DEFAULT_COMMUNE = 26; // La Serena

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pch_provider_branch_offices';

    protected $fillable = [
        'pch_provider_id',
        'g_commune_id',
        'address',
        'phone',
        'email',
        'default_branch_office',
        'flag_delete'
    ];

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
    public function gCommune()
    {
        return $this->belongsTo('Modules\General\Entities\GCommune');
    }
}
