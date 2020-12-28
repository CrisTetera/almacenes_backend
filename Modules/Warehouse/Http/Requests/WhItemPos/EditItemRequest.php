<?php

namespace Modules\Warehouse\Http\Requests\WhItemPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $wh_product_id
 */
class EditItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            'wh_product_id' => 'required|integer|min:1,exists:wh_product_pos,id,flag_delete,false',
            'have_decimal_quantity' => 'required|boolean',
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
