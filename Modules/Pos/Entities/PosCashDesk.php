<?php

namespace Modules\Pos\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $g_branch_office_id
 * @property string $number
 * @property string $name
 * @property boolean $flag_delete
 * @property GBranchOffice $gBranchOffice
 * @property PosCashMovement[] $posCashMovements
 * @property PosDailyCash[] $posDailyCashes
 * @property PosSale[] $posSales
 * @property PosEmployeeSale[] $posEmployeeSales
 */
class PosCashDesk extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pos_cash_desk';

    /**
     * @var array
     */
    protected $fillable = ['g_branch_office_id', 'number', 'name', 'flag_delete'];



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
    public function posCashMovements()
    {
        return $this->hasMany('Modules\Pos\Entities\PosCashMovement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posDailyCashes()
    {
        return $this->hasMany('Modules\Pos\Entities\PosDailyCash');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosSale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posEmployeeSales()
    {
        return $this->hasMany('Modules\Pos\Entities\PosEmployeeSale');
    }
}
