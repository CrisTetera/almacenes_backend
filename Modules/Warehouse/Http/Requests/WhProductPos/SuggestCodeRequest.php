<?php

namespace Modules\Warehouse\Http\Requests\WhProductPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $family_id
 * @property integer $subfamily_id
 * @property integer $product_name
 */
class SuggestCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_family_id' => 'required|integer|min:1|max:99999',
            'wh_subfamily_id' => 'required|integer|min:1|max:99999',
            'product_name' => 'required|string|min:1|max:255'
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
