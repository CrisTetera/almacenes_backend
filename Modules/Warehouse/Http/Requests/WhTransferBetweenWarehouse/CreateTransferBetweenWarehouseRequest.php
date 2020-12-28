<?php

namespace Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $wh_from_warehouse_id
 * @property int $wh_to_warehouse_id
 * @property int $g_from_supervisor_id
 * @property int $g_to_supervisor_id
 * @property string $description
 * @property array $details
 */
class CreateTransferBetweenWarehouseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_from_warehouse_id' => 'required|integer|min:1|exists:wh_warehouse,id,flag_delete,false',
            'g_from_supervisor_id' => 'required|integer|min:1|exists:g_user,id,flag_delete,false',
            'wh_to_warehouse_id' => 'required|integer|min:1|exists:wh_warehouse,id,flag_delete,false',
            'description' => 'nullable|string|max:500',

            'details' => 'required|array|min:1',
            'details.*.wh_product_id' => 'required|integer|min:1|exists:wh_product,id,flag_delete,false',
            'details.*.quantity' => 'required|integer|min:0'
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
