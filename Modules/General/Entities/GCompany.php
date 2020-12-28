<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string rut
 * @property string business_name
 * @property string state
 * @property string commercial_business
 * @property string commercial_activity_code
 * @property string address
 * @property int commune_id
 * @property string api_key_open_factura
 * @property string path_icon
 * @property GBranchOffice[] $gBranchOffices
 */
class GCompany extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_company';

    /**
     * @var array
     */
    protected $fillable = [
        'rut',
        'business_name',
        'state',
        'commercial_business',
        'commercial_activity_code',
        'address',
        'commune_id',
        'api_key_open_factura',
        'path_icon'
    ];

    /**
     * Returns formatted rut. Ex: From 12345678-9 to 12.345.678-9
     */
    public function formattedRut()
    {
        $rut = str_replace(['.', '-'], ['', ''], $this->rut);
        $rutNoDV = substr($rut, 0, strlen($rut) - 1);
        $dv = substr($rut, strlen($rut) - 1);
        $formattedRut = number_format($rutNoDV, 0, ',', '.').'-'.$dv;
        return $formattedRut;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gBranchOffices()
    {
        return $this->hasMany('Modules\General\Entities\GBranchOffice');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCommune()
    {
        return $this->belongsTo('Modules\General\Entities\GCommune', 'commune_id');
    }
}
