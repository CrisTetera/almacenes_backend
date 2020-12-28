<?php

namespace Modules\General\Http\Requests\GUser;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $rut
 * @property string $names
 * @property string $last_name1
 * @property string $last_name2
 * @property string $email
 * @property integer $role
 * @property boolean $is_ground_seller
 * @property array $commissions
 * @property array $customers
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
            'names' => 'required|string|min:1|max:255',
            'last_name1' => 'required|string|min:1|max:255',
            'last_name2' => 'nullable|string|min:1|max:255',
            'email' => 'required|string|min:1|max:100',
            'role' => 'required|integer|min:1|max:20|exists:roles,id',
            'is_ground_seller' => 'nullable|boolean',
            'commissions' => 'nullable|array|exists:sl_commission,id',
            'customers' => 'nullable|array|exists:sl_customer,id'
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
