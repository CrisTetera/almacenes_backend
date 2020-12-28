<?php

namespace Modules\Hr\Services\HrEmployee;

use Modules\HR\Entities\HrEmployee;
use Modules\Sale\Entities\SlCommissionHrEmployee;

class CrudHrEmployeeCommissionsService
{

    /**
     * Maneja las comisiones.
     * 1. Elimina comisiones no presentes en el empleado.
     * 2. Por cada comisión verifica:
     *  2.a. Si existe comisión asociada al empleado no hace nada.
     *  2.b. Si no existe comisión asociada al empleado, la asocia
     *
     * @param HrEmployee $employee
     * @param array $request
     * @return void
     */
    public function handleCommissions(HrEmployee $employee, $request)
    {
        if ($this->hasToSaveCommissions($request))
        {
            $this->deleteCommissions($employee, $request->commissions);
            foreach($request->commissions as $commissionId)
            {
                $this->syncCommission($employee, $commissionId);
            }
        }
    }

    private function hasToSaveCommissions($request)
    {
        return isset($request['commissions']) && is_array($request->commissions);
    }

    private function deleteCommissions(HrEmployee $employee, $commissionIds = [])
    {
        SlCommissionHrEmployee::where('hr_employee_id', $employee->id)
                                ->whereNotIn('sl_commission_id', $commissionIds)
                                ->delete();
    }

    private function syncCommission(HrEmployee $employee, $commissionId)
    {
        $employee->commissions()->sync([$commissionId], false);
    }

}
