<?php

namespace Modules\General\Http\Requests\GMenu;

use Illuminate\Foundation\Http\FormRequest;

class GetMenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'g_module_id' => 'required|integer|exists:g_module_pos,id'
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
            'g_module_id.required' => 'ID de módulo no seleccionado',
            'g_module_id.integer' => 'ID de módulo no existe en el sistema',
            'g_module_id.exists' => 'ID de módulo no existe en el sistema',
        ];
    }
}
