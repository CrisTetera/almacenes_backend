<?php

namespace Modules\Sale\Http\Requests\SlCustomerPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $rut
 * @property string $business_name
 * @property string $alias_name
 * @property string $commercial_business
 * @property string $address
 * @property string $phone_number
 * @property mixed $email
 * @property integer $g_commune_id
 */
class CreateSlCustomerRequest extends FormRequest
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
            'business_name' => 'required|max:255',  // Razón social
            'alias_name' => 'required|max:255', // Nombre / Nombre de Fantasía
            'commercial_business' => 'required|max:500', // Giro
            'address' => 'required|string|max:500',
            'phone_number' => 'nullable|max:50',
            'email' => 'nullable|max:100|email',
            'g_commune_id' => 'required|integer|min:1|exists:g_commune_pos,id',
            'is_company' => 'required|boolean'


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
