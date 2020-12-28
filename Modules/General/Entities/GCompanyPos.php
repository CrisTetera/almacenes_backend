<?php

namespace Modules\General\Entities;

use Illuminate\Database\Eloquent\Model;

class GCompanyPos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'g_company_pos';

    protected $fillable = [
        'rut',
        'business_name',
        'state',
        'commercial_business',
        'commercial_activity_code',
        'address',
        'g_commune_id',
        'api_key_open_factura',
        'sii_branch_office_sii',
        'path_icon',
        'flag_delete'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCommunePos()
    {
        return $this->belongsTo('Modules\General\Entities\GCommunePos', 'g_commune_id');
    }
}
