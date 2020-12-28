<?php

namespace Modules\Warehouse\Http\Requests\WhWarehouseType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $type
 */
class CreateWarehouseTypeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|min:1|max:100'
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
