<?php

namespace Modules\HR\Entities;

use Illuminate\Database\Eloquent\Model;

class HrEmployeePos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hr_employee_pos';

    protected $fillable = [
        'rut',
        'first_names',
        'last_name1',
        'last_name2',
        'email',
        'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gUserPos()
    {
        return $this->hasMany('Modules\General\Entities\GUserPos');
    }

    /**
     * Get full name of HrEmployee
     * 
     * @return string fullname
     */
    public function getFullName()
    {
        return $this->first_names . ' ' . $this->last_name1 . ' ' . $this->last_name2;
    }
}
