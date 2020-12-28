<?php

namespace Modules\Warehouse\Http\Requests\WhProduct;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $g_branch_office_id
 * @property array $products
 */
class MassiveMarginPriceProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'g_branch_office_id' => 'required|integer|min:1|exists:g_branch_office,id',
            'products' => 'required|array|min:1',
            'products.*.wh_product_id' => 'required|integer|min:1|exists:wh_product,id',
            'products.*.gains_margin' => 'required|numeric|min:0|max:1000',
            'products.*.sale_price' => 'required|integer|min:0',
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
