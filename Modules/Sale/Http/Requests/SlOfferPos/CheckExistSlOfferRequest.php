<?php

namespace Modules\Sale\Http\Requests\SlOfferPos;

use Illuminate\Foundation\Http\FormRequest;
// Add custom rules
use Illuminate\Validation\Factory as ValidationFactory;
use Modules\Sale\Http\Requests\SlOfferPos\CustomValidations\SlOfferCustomValidation;

class CheckExistSlOfferRequest extends FormRequest
{
    /**
     * Construct for added custom Validate:
     * 1) array_integer_or_integer => check if param is Integer array or Integer
     * 2) exist_from_array => check if param (Integer or Array) exist in DB 
     *  
     * @param Illuminate\Validation\Factory $validationFactory
     * @return void
     */    
    public function __construct(ValidationFactory $validationFactory)
    {
        $validationFactory->extend(
            'array_integer_or_integer',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::isIntegerOrArrayInteger($attribute, $value, $parameters);
            },
            'El campo productos no es válido'
        );

        $validationFactory->extend(
            'exists_from_array',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::existsFromArray($attribute, $value, $parameters);
            },
            'No todos los productos ingresados existen en la Base de Datos'
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_products' => 'required|array_integer_or_integer|exists_from_array:wh_product_pos,id',
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
