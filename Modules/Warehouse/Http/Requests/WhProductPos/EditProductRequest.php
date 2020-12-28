<?php

namespace Modules\Warehouse\Http\Requests\WhProductPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $description
 * @property string $upc
 * @property integer $wh_subfamily_id
 * @property boolean $is_tax_free
 * @property int $cost_price
 * @property int $gains_margin
 *
 * @property array $tags
 * @property array $sl_price_list
 *
 */
class EditProductRequest extends FormRequest
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
            'description'=> 'required|string|max:255',
            'wh_subfamily_id' => 'required|integer|min:1|exists:wh_subfamily_pos,id',
            // 'path_logo' => 'nullable|string|min:0|max:255',
            'is_tax_free' => 'required|boolean',
            'upc' => 'string|min:0',
            'cost_price' => 'required|numeric|min:0',
            'gains_margin' => 'required|numeric|min:0',

            'tags' => 'array|min:0|exists:wh_tag_pos,id',

            'sale_price' => 'required|integer|min:0',

            'stock' => 'nullable|integer|min:0',
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
