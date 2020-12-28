<?php

namespace Modules\Pos\Http\Requests\Pos;

use Illuminate\Foundation\Http\FormRequest;

class GetCompleteResumePosDailyCashRequest extends FormRequest
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
            'auth_code_supervisor' => 'required|max:12',
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
            'pos_cash_desk_id.integer' => 'El código de caja no debe ser una cadena de texto',
        ];
    }
}
