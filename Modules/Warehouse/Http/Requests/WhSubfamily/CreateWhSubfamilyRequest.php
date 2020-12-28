<?php

namespace Modules\Warehouse\Http\Requests\WhSubfamily;

use Illuminate\Foundation\Http\FormRequest;

class CreateWhSubfamilyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subfamily' => 'required|min:1|max:100',
            'wh_family_id' => 'required|integer|min:1|exists:wh_family,id'
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
