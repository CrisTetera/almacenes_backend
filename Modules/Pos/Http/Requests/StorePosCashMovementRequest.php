<?php

namespace Modules\Pos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePosCashMovementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pos_cash_desk_id' => 'required|integer|exists:pos_cash_desk,id',
            'pos_cash_movement_egress_type_id' => 'nullable|integer|exists:pos_cash_movement_egress_type,id',
            'pos_cash_movement_ingress_type_id' => 'nullable|integer|exists:pos_cash_movement_ingress_type,id',
            'g_user_id' => 'required|integer|exists:g_user,id',
            'amount' => 'required|integer|min:1',
            'observation' => 'nullable|string|max:500',
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

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pos_cash_desk_id.required' => 'Caja no seleccionada',
            'pos_cash_desk_id.integer' => 'Caja no existe en el sistema',
            'pos_cash_desk_id.exists' => 'Caja no existe en el sistema',
            'pos_cash_movement_egress_type_id.integer' => 'Movimiento de egreso no existe en el sistema',
            'pos_cash_movement_egress_type_id.exists' => 'Movimiento de egreso no existe en el sistema',
            'pos_cash_movement_ingress_type_id.integer' => 'Movimiento de ingreso no existe en el sistema',
            'pos_cash_movement_ingress_type_id.exists' => 'Movimiento de ingreso no existe en el sistema',
            'amount.required' => 'El monto es obligatorio',
            'amount.integer' => 'El monto debe ser numérico',
            'amount.min' => 'El monto debe ser mayor que 0',
            'observation.string' => 'La observacion debe ser una cadena de caracteres',
            'observation.max' => 'La observación debe tener un máximo de 500 caracteres',
        ];
    }
}
