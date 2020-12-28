<?php

namespace Modules\Warehouse\Http\Requests\WhOrderer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $pch_provider_id
 * @property integer $pch_provider_branch_offices_id
 * @property integer $wh_orderer_priority_id
 * @property integer $g_supervisor_user_id
 * @property array $details
 */
class EditOrdererRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pch_provider_id' => 'required|integer|min:1|exists:pch_provider,id,flag_delete,false',
            'pch_provider_branch_offices_id' => 'required|integer|min:1|exists:pch_provider_branch_offices,id,flag_delete,false',
            'wh_orderer_priority_id' => 'required|integer|min:1|exists:wh_orderer_priority,id,flag_delete,false',
            'g_supervisor_user_id' => 'required|integer|min:1|exists:g_user,id,flag_delete,false',
            'wh_warehouse_id' => 'required|integer|min:1|exists:wh_warehouse,id,flag_delete,false',
            'details' => 'required|array|min:1',
            'details.*.wh_product_id' => 'required|integer|min:1|exists:wh_product,id,flag_delete,false',
            'details.*.provider_product_code' => 'nullable|string|min:0|max:20',
            'details.*.quantity' => 'required|numeric|min:0.1',
            'details.*.brand' => 'nullable|string|min:0|max:20',
            'details.*.description' => 'nullable|string|min:0|max:255',
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
