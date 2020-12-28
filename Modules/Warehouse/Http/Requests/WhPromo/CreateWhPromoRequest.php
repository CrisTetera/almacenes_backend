<?php

namespace Modules\Warehouse\Http\Requests\WhPromo;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouse\Http\Requests\WhProduct\CreateWhProductRequest;

class CreateWhPromoRequest extends CreateWhProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            // Extra
            'products' => 'required|array|min:1',
            'products.*.wh_product_id' => 'required|integer|min:1',
            'products.*.quantity' => 'required|integer|min:1|max:9999',
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
