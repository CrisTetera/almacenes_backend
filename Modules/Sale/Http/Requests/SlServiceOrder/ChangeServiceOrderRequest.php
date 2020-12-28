<?php

namespace Modules\Sale\Http\Requests\SlServiceOrder;

use Illuminate\Foundation\Http\FormRequest;

class ChangeServiceOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Service Order Data Request
            'comment' => 'present|max:500',
            'dte_number' => 'required|integer',
            'is_ticket' => 'required|boolean',
            'seller_user_code' => 'required|string',
            'supervisor_user_code' => 'required|string',
            'in' => 'required|min:1',
            'in.*.product_id' => 'required|integer|min:1',
            'in.*.quantity' => 'required|integer|min:1',
            // Sale Data Request
            'customer_id' => 'nullable',
            'customer' => 'nullable',
            'sucursal_id' => 'required|integer|min:1',
            'pos_sale_type' => 'required|integer|min:1|max:2',
            'global_discount' => 'required|integer|min:0|max:100',
            'global_discount_amount' => 'required|integer|min:0',
            'total' => 'required|integer|min:0',
            'sale_detail' => 'required|min:1',
            'sale_detail.*.product_id' => 'required|integer|min:1',
            'sale_detail.*.quantity' => 'required|integer|min:1',
            'sale_detail.*.price' => 'required|integer|min:0',
            'sale_detail.*.discount' => 'required|integer|min:0',
            'sale_detail.*.discount_unit_price' => 'required|integer|min:0',
            'sale_detail.*.wh_warehouse_id' => 'required|integer|min:1'
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
