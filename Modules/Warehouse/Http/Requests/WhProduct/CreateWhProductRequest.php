<?php

namespace Modules\Warehouse\Http\Requests\WhProduct;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $alias_name
 * @property string $description
 * @property string $internal_code
 * @property integer $wh_subfamily_id
 * @property integer $warranty_days
 * @property boolean $is_repackaged
 * @property boolean $is_tax_free
 * @property boolean $is_salable
 * @property boolean $is_consumable
 * @property boolean $is_seasonal
 *
 * @property array $tags
 * @property array $upc_codes
 * @property array $branch_office_data
 *
 */
class CreateWhProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'alias_name' => 'required|string|max:255',
            'description' => 'min:0|max:500',
            'internal_code' => 'required|string|max:20',
            'wh_subfamily_id' => 'required|integer|min:1|exists:wh_subfamily,id',
            'warranty_days' => 'required|integer|min:0',
            'is_repackaged' => 'required|boolean',
            'is_tax_free' => 'required|boolean',
            'have_decimal_quantity' => 'required|boolean',
            'is_salable' => 'required|boolean',
            'is_consumable' => 'required|boolean',
            'is_seasonal' => 'required|boolean',

            'tags' => 'array|min:0|exists:wh_tag,id',

            'upc_codes' => 'array|min:0',
            'branch_office_data' => 'required|array|min:1',
            'branch_office_data.*.g_branch_office_id' => 'required|integer|min:0|exists:g_branch_office,id',
            'branch_office_data.*.cost_price' => 'required|numeric|min:0',
            'branch_office_data.*.sale_price' => 'required|integer|min:0',
            'branch_office_data.*.gains_margin' => 'required|numeric|min:0',
            'branch_office_data.*.minimum_stock' => 'required|numeric|min:0',
            'branch_office_data.*.maximum_stock' => 'required|numeric|min:0',
            'branch_office_data.*.critical_stock' => 'required|numeric|min:0'
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
