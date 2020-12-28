<?php

namespace Modules\Sale\Http\Requests\SlOffer;

use Illuminate\Foundation\Http\FormRequest;
// Add custom rules
use Illuminate\Validation\Factory as ValidationFactory;
use Modules\Sale\Http\Requests\SlOffer\CustomValidations\SlOfferCustomValidation;

class MassiveEditSlOfferRequest extends FormRequest
{
    /**
     * Construct for added custom Validate:
     * 1) array_structure_create_massive => check if param is correct structure for wh_products array (for massive create)
     * 2) exists_from_array_create_massive => check if params (array of integer) exist in DB (in wh_product table) 
     *  
     * @param Illuminate\Validation\Factory $validationFactory
     * @return void
     */    
    public function __construct(ValidationFactory $validationFactory)
    {
        $validationFactory->extend(
            'array_structure_create_edit_massive',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::checkArrayStructureEditMassive($attribute, $value, $parameters);
            },
            'El arreglo de ofertas no es válido'
        );

        $validationFactory->extend(
            'exists_from_array_edit_massive',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::existsFromArrayEditMassive($attribute, $value, $parameters);
            },
            'No todas las ofertas ingresadas existen en la Base de Datos'
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
            'sl_offers' => 'bail|required|array_structure_create_edit_massive|exists_from_array_edit_massive:sl_offer,id',
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
