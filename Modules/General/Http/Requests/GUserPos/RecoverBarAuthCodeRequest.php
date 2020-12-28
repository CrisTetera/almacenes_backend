<?php

namespace Modules\General\Http\Requests\GUserPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property integer $g_user_id
 */
class RecoverBarAuthCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'g_user_id' => 'required|integer|min:1'
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
