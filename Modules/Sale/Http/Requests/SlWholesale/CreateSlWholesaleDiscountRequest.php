<?php

namespace Modules\Sale\Http\Requests\SlWholesale;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $wh_product_id
 * @property integer $g_branch_office_id
 * @property array $discount_schema
 */
class CreateSlWholesaleDiscountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_product_id' => 'required|integer|min:1|exists:wh_product,id',
            'g_branch_office_id' => 'required|integer|min:1|exists:g_branch_office,id',
            'discount_schema' => 'required|array|min:1',
            'discount_schema.*.quantity_discount' => 'required|integer|min:1',
            'discount_schema.*.percentage_discount' => 'required|integer|min:0',
            'discount_schema.*.unit_price_discount' => 'required|integer|min:0'
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
