<?php

namespace Modules\Purchase\Http\Requests\PchPurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $pch_provider_id
 * @property int $pch_provider_branch_offices_id
 * @property int $pch_payment_condition_id
 * @property int $wh_warehouse_id
 * @property int $g_originator_user_id
 * @property string $observation
 * @property array $details
 * @property array $orderers
 */
class EditPurchaseOrderRequest extends FormRequest
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
            'pch_payment_condition_id' => 'required|integer|min:1|exists:pch_payment_condition,id,flag_delete,false',
            'wh_warehouse_id' => 'required|integer|min:1|exists:wh_warehouse,id,flag_delete,false',
            'g_originator_user_id' => 'required|integer|min:1|exists:g_user,id,flag_delete,false',
            'observation' => 'nullable|string|min:0|max:500',

            'details' => 'required|array|min:1',
            'details.*.provider_product_code' => 'nullable|string|min:0|max:20',
            'details.*.wh_product_id' => 'required|integer|min:1|exists:wh_product,id,flag_delete,false',
            'details.*.quantity' => 'required|numeric|min:0.1',
            'details.*.net_price' => 'required|numeric|min:0',

            'orderers' => 'array|min:0|exists:wh_orderer,id,flag_delete,false',
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
