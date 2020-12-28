<?php

namespace Modules\Sale\Http\Requests\SlCommission;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer sl_commission_type_id
 * @property string name
 * @property string description
 * @property float percentage
 */
class EditSlCommissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sl_commission_type_id' => 'required|integer|min:1|exists:sl_commission_type,id',
            'name' => 'required|string|min:1|max:80',
            'description' => 'nullable|string|max:500',
            'percentage' => 'required|numeric|min:0|max:100'
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
