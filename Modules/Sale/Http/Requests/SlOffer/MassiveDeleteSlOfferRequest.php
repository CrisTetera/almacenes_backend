<?php

namespace Modules\Sale\Http\Requests\SlOffer;

use Illuminate\Foundation\Http\FormRequest;
// Add custom rules
use Illuminate\Validation\Factory as ValidationFactory;
use Modules\Sale\Http\Requests\SlOffer\CustomValidations\SlOfferCustomValidation;

class MassiveDeleteSlOfferRequest extends FormRequest
{
    /**
     * Construct for added custom Validate:
     * 1) array_integer_or_integer => check if param is correct structure for sl_offers array (for massive delete)
     * 2) exists_from_array => check if params (array of integer) exist in DB (in sl_offer table) 
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
            'El campo de ofertas no es válido'
        );

        $validationFactory->extend(
            'exists_from_array',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::existsFromArray($attribute, $value, $parameters);
            },
            'No todos las ofertas ingresadas existen en la Base de Datos'
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
            'sl_offers' => 'bail|required|array_integer_or_integer|exists_from_array:sl_offer,id',
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
