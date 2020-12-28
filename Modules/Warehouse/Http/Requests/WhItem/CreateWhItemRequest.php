<?php

namespace Modules\Warehouse\Http\Requests\WhItem;

use Modules\Warehouse\Http\Requests\WhProduct\CreateWhProductRequest;

/**
 * @property integer $wh_unit_of_measurement_id
 * @property integer $uom_quantity
 * @property boolean $is_inventoriable
 * @property boolean $have_decimal_quantity
 */
class CreateWhItemRequest extends CreateWhProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            'wh_unit_of_measurement_id' => 'required|integer|min:1|exists:wh_unit_of_measurement,id',
            'uom_quantity' => 'required|numeric|min:1',
            'is_inventoriable' => 'required|boolean',
            'have_decimal_quantity' => 'required|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
