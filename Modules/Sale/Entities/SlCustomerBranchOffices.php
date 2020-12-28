<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $sl_customer_id
 * @property integer $g_commune_id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property boolean $default_branch_office
 * @property boolean $flag_delete
 * @property SlCustomer $slCustomer
 * @property GCommune $gCommune
 */
class SlCustomerBranchOffices extends Model
{

    public const DEFAULT_COMMUNE = 26; // La Serena

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sl_customer_branch_offices';

    protected $fillable = [
        'sl_customer_id',
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
    public function slCustomer()
    {
        return $this->belongsTo('Modules\Sale\Entities\SlCustomer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gCommune()
    {
        return $this->belongsTo('Modules\General\Entities\GCommune');
    }
}
