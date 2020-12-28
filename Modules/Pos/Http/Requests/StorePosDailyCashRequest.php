<?php

namespace Modules\Pos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePosDailyCashRequest extends FormRequest
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
            'g_cashier_user_id' => 'required|integer|exists:g_user,id',
            'initial_amount_cash' => 'required|integer|min:0',
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
            'g_cashier_user_id.required' => 'Usuario no seleccionado',
            'g_cashier_user_id.integer' => 'Usuario no existe en el sistema',
            'g_cashier_user_id.exists' => 'Usuario no existe en el sistema',
            'initial_amount_cash.required' => 'La cantidad inicial es obligatorio',
            'initial_amount_cash.integer' => 'La cantidad inicial debe ser numérico',
            'initial_amount_cash.min' => 'La cantidad incial debe ser mayor o igual que 0',
            'observation.string' => 'La observacion debe ser una cadena de caracteres',
            'observation.max' => 'La observación debe tener un máximo de 500 caracteres',
        ];
    }
}
