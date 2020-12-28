<?php

namespace Modules\Warehouse\Http\Requests\WhProduct;

use Illuminate\Foundation\Http\FormRequest;

class UploadLogoWhProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo' => 'required|max:1024|mimes:jpeg,png,bmp'
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

    /**
     * Custom messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'logo.required' => "Debes subir una imagen",
            'logo.max' => "El tamaño máximo de la foto es de :max kb",
            'logo.mimes' => "Solo se acepta: :values"
        ];
    }
}
