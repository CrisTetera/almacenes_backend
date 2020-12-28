<?php

namespace Modules\General\Http\Requests\GUserPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $rut
 * @property string $firstnames
 * @property string $last_name1
 * @property string $last_name2
 * @property string $email
 */
class CreateGUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rut' => 'required|max:10|cl_rut', // Ejemplo 12345678-0
            'firstnames' => 'required|string|min:1|max:255',
            'last_name1' => 'required|string|min:1|max:255',
            'last_name2' => 'nullable|string|min:1|max:255',
            'email' => 'required|string|min:1|max:100'
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