<?php

namespace Modules\Sale\Services\SlCommission;

use Modules\Sale\Http\Requests\SlCommission\CreateSlCommissionRequest;
use Dotenv\Exception\ValidationException;
use Modules\Sale\Entities\SlCommission;
use Modules\Sale\Http\Requests\SlCommission\EditSlCommissionRequest;

class CrudSlCommissionService
{

    public function store(CreateSlCommissionRequest $request)
    {
        $commission = new SlCommission();
        $this->setSlCommissionParams($commission, $request);
        $commission->save();
        return $commission->id;
    }

    public function update($idSlCommission, EditSlCommissionRequest $request)
    {
        $commission = $this->checkCommission($idSlCommission);
        $this->setSlCommissionParams($commission, $request);
        $commission->save();
        return $commission->id;
    }

    public function delete($idSlCommission)
    {
        $commission = $this->checkCommission($idSlCommission);
        $commission->flag_delete = true;
        $commission->save();
    }

    public function setSlCommissionParams(SlCommission &$commission, $request)
    {
        $commission->name = $request->name;
        $commission->description = isset($request['description']) && $request->description ? $request->description : '';
        $commission->percentage = $request->percentage;
        $commission->sl_commission_type_id = $request->sl_commission_type_id;
    }

    private function checkCommission($idSlCommission)
    {
        $commission = SlCommission::where('id', $idSlCommission)->where('flag_delete', false)->first();
        if (!$commission)
        {
            throw new ValidationException("La comisión ($idSlCommission) no existe");
        }
        return $commission;
    }

}
