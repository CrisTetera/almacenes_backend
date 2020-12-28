<?php

namespace Modules\Warehouse\Http\Requests\WhPacking;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouse\Http\Requests\WhProduct\CreateWhProductRequest;

/**
 * @property integer $wh_product_content_id
 * @property integer $quantity_product
 */
class CreateWhPackingRequest extends CreateWhProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            'wh_product_content_id' => 'required|integer|min:1|exists:wh_product,id',
            'quantity_product' => 'required|integer|min:1'
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
