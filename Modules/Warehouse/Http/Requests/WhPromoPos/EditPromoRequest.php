<?php

namespace Modules\Warehouse\Http\Requests\WhPromoPos;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

class EditPromoRequest extends EditProductRequest
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
            'products.*.wh_product_id' => 'required|integer|min:1,exists:wh_product_pos,id,flag_delete,false',
            'products.*.quantity' => 'required|integer|min:1|max:9999'
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
