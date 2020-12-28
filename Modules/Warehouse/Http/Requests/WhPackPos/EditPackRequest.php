<?php

namespace Modules\Warehouse\Http\Requests\WhPackPos;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouse\Http\Requests\WhProductPos\EditProductRequest;

/**
 * @property integer $wh_item_id
 * @property integer $item_quantity
 */
class EditPackRequest extends EditProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return parent::rules() + [
            'wh_item_id' => 'required|integer|min:1|exists:wh_item_pos,id',
            'item_quantity' => 'required|integer|min:1'
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
