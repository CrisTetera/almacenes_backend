<?php

namespace Modules\Pos\Http\Requests\Pos;

use Illuminate\Foundation\Http\FormRequest;

class PaySaleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pos_sale_type_id' => 'required|integer|exists:pos_sale_type_pos,id',
            'pos_sale_id' => 'required|integer|exists:pos_sale_pos,id',
            'g_cashier_id' => 'nullable|integer|exists:g_user_pos,id',
            'pos_cash_desk_id' => 'required|integer|min:1|max:50|exists:pos_cash_desk_pos,id',
            // 'sl_customer_id' => 'required|integer|min:1|max:50|exists:sl_customer_pos,id',
            'pos_payment_sale' => 'required|array|min:1',
            // 'pos_payment_sale.*.pos_payment_sale_id' => 'required|integer|max:50',
            'pos_payment_sale.*.amount_payment' => 'required|integer|min:1',
            'pos_payment_sale.*.rounding_law' => 'nullable|integer|max:50',
            'pos_payment_sale.*.transfer_number' => 'nullable|string',
            'pos_payment_sale.*.sl_customer_id' => 'nullable|integer|min:1|exists:sl_customer_pos,id',
            'pos_payment_sale.*.pos_type_payment_method_id' => 'required|integer|exists:pos_type_payment_method_pos,id'
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

    // public function messages()
    // {
    //     return [
    //         'pos_sale_id.required' => 'Venta no seleccionada',
    //         'pos_sale_id.integer' => 'Venta no existe en el sistema',
    //         'pos_sale_id.exists' => 'Venta no existe en el sistema',
    //         'pos_sale_type_id.required' => 'El tipo de venta no ha sido enviado',
    //         'pos_sale_type_id.min' => 'El tipo de venta debe ser mayor a 0',
    //         'pos_sale_type_id.exists' => 'El tipo de venta no existe en el sistema',
    //         'pos_payment_sale.*.amount_payment.request' => 'El monto no ha sido ingresado',
    //         'pos_payment_sale.*.amount_payment.integer' => 'El monto debe ser valido',
    //         'pos_payment_sale.*.amount_payment.min' => 'El monto debe ser mayor o igual que 1',
    //         'pos_payment_sale.*.pos_type_payment_method_id.request' => 'El método de pago no ha sido ingresado',
    //         'pos_payment_sale.*.pos_type_payment_method_id.integer' => 'El método de pago debe ser valido',
    //         'pos_payment_sale.*.pos_type_payment_method_id.min' => 'El métodode de pago debe ser mayor o igual que 1',
    //         'pos_payment_sale.*.pos_type_payment_method_id.exists' => 'El método de pago no existe en el sistema',
    //     ];
    // }
}
