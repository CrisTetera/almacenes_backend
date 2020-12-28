<?php

namespace Modules\Purchase\Http\Requests\PchProvider;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $rut
 * @property string $business_name
 * @property string $alias_name
 * @property string $core_business
 * @property array $branch_offices
 */
class CreateProviderRequest extends FormRequest
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

            'branch_offices' => 'required|array|min:1',
            'branch_offices.*.address' => 'required|string|max:500',
            'branch_offices.*.phone' => 'nullable|max:50',
            'branch_offices.*.email' => 'nullable|max:100|email',
            'branch_offices.*.g_commune_id' => 'required|integer|min:1|exists:g_commune,id',
            'branch_offices.*.default_branch_office' => 'required|boolean',
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
