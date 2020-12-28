<?php

namespace Modules\General\Http\Requests\GTemporalModuleToken;

use Illuminate\Foundation\Http\FormRequest;

class GetUserTokenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'module_token' => 'required|string|exists:g_temporal_module_token,module_token',
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
