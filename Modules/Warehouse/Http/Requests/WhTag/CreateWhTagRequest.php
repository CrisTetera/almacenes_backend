<?php

namespace Modules\Warehouse\Http\Requests\WhTag;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $tag
 * @property string $description
 */
class CreateWhTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag' => 'required|string|min:1|max:100',
            'description' => 'string|nullable|max:500'
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
