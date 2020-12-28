<?php

namespace Modules\Pos\Http\Requests\Pos;

use Illuminate\Foundation\Http\FormRequest;

class ClosePosDailyCashRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pos_cash_desk_id' => 'required|integer|exists:pos_cash_desk_pos,id',
            'g_cashier_closure_user_id' => 'required|integer|exists:g_user_pos,id',
            'auth_code_supervisor' => 'required|string|max:12|exists:g_user_pos,auth_code',
            'real_cash_total' => 'required|integer|min:0',
            'closure_observation' => 'nullable|string|max:500',
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
            'pos_cash_desk_id.exists' => 'El código de caja no existe en nuestros registros',
            'g_cashier_closure_user_id.required' => 'El ID del cajero que cierra el arqueo de caja es obligatorio',
            'g_cashier_closure_user_id.integer' => 'El ID del cajero que cierra el arqueo de caja debe ser entero',
            'g_cashier_closure_user_id.exists' => 'El ID del cajero que cierra el arqueo de caja debe existir en nuestros registros',
            'auth_code_supervisor.exists' => 'El código de supervisor proporcionado no existe en nuestros registros',
            'real_cash_total.required' => 'El campo Total real en caja es obligatorio',
            'real_cash_total.integer' => 'El campo Total real en caja debe ser un número entero',
            'real_cash_total.min' => 'El campo Total real debe ser mayor que 0',
            'closure_observation.string' => 'El campo observación debe ser una texto',
            'closure_observation.max' => 'El campo observación debe no debe exceder el máximo de 500 caracteres',
        ];
    }
}
