<?php

namespace Modules\Warehouse\Http\Requests\WhWarehousePos;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @property string $name
 * @property string $description
 * @property string $address
 */
class CreateWarehouseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'description' => 'nullable|string|min:0|max:500',
            'address' => 'nullable|string|min:0|max:500'
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
