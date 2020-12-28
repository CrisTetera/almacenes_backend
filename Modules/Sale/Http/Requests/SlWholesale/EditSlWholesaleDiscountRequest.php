<?php

namespace Modules\Sale\Http\Requests\SlWholesale;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $g_branch_office_id
 * @property array $discount_schema
 */
class EditSlWholesaleDiscountRequest extends FormRequest
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
            'discount_schema' => 'nullable|array|min:0',
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
