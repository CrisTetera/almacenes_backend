<?php

namespace Modules\Warehouse\Http\Requests\WhWarehouse;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @property int $g_branch_office_id
 * @property int $wh_warehouse_type_id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property boolean $is_waste_warehouse
 */
class CreateWarehouseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'g_branch_office_id' => 'required|integer|min:1|exists:g_branch_office,id,flag_delete,false',
            'wh_warehouse_type_id' => 'required|integer|min:1|exists:wh_warehouse_type,id,flag_delete,false',
            'name' => 'required|string|min:1|max:255',
            'description' => 'nullable|string|min:0|max:500',
            'address' => 'nullable|string|min:0|max:500',
            'is_waste_warehouse' => 'required|boolean'
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
