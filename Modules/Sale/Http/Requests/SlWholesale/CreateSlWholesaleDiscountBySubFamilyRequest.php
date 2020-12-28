<?php

namespace Modules\Sale\Http\Requests\SlWholeSale;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $wh_subfamily_id
 * @property integer $g_branch_office_id
 * @property array $discount_schema
 */
class CreateSlWholesaleDiscountBySubFamilyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_subfamily_id' => 'required|integer|min:1|exists:wh_subfamily,id',
            'g_branch_office_id' => 'required|integer|min:1|exists:g_branch_office,id',
            'discount_schema' => 'required|array|min:1',
            'discount_schema.*.quantity_discount' => 'required|integer|min:1',
            'discount_schema.*.percentage_discount' => 'required|integer|min:0',
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
