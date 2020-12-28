<?php

namespace Modules\Pos\Http\Requests\Pos;

use Illuminate\Foundation\Http\FormRequest;

class CreatePosSalePosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sl_invoice_id' => 'nullable|integer|max:50|exist:sl_invoice_pos,id',
            'sl_ticket_id' => 'nullable|integer|max:50|exist:sl_ticket_pos,id',
            'pos_cash_desk_id' => 'nullable|integer|max:50|exist:pos_cash_desk_pos,id',
            'g_cashier_id' => 'nullable|integer|max:50|exist:g_user_pos,id',
            'g_state_id' => 'required|integer|max:50|exist:g_state_pos,id',
            'pos_sale_type_id' => 'required|integer|max:50|exist:pos_sale_type_pos,id',
            'sl_customer_id' => 'nullable|integer|max:50|exist:sl_customer_pos,id',
            'global_discount_percentage' => 'nullable|integer|max:50',
            'global_discount_amount' => 'nullable|integer|max:50',
            // 'rounding_law' => 'nullable|integer|max:50',


            'pos_detail' => 'required|array|min:1',
            'pos_detail.*.line_number' => 'required|integer|min:1',
            //'pos_detail.*.wh_warehouse_id' =>'required|integer|min:1|exist:wh_warehouse_pos,id',
            'pos_detail.*.wh_product_id' => 'required|integer|max:50|exist:wh_product_pos,id',
            'pos_detail.*.quantity' => 'required|integer|max:50',
            'pos_detail.*.price'=> 'required|integer|max:50',
            'pos_detail.*.discount_percentage' => 'nullable|integer|max:50',
            'pos_detail.*.discount_amount' => 'nullable|integer|max:50',
            'pos_detail.*.wh_warehouse_id'=> 'required|integer|max:50',
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
