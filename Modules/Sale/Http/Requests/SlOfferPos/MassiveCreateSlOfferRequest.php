<?php

namespace Modules\Sale\Http\Requests\SlOfferPos;

use Illuminate\Foundation\Http\FormRequest;
// Add custom rules
use Illuminate\Validation\Factory as ValidationFactory;
use Modules\Sale\Http\Requests\SlOfferPos\CustomValidations\SlOfferCustomValidation;

class MassiveCreateSlOfferRequest extends FormRequest
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
            'array_structure_create_massive',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::checkArrayStructureCreateMassive($attribute, $value, $parameters);
            },
            'El arreglo de productos no es válido'
        );

        $validationFactory->extend(
            'exists_from_array_create_massive',
            function ($attribute, $value, $parameters) {
                return SlOfferCustomValidation::existsFromArrayCreateMassive($attribute, $value, $parameters);
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
        // bail rule avoid that next rule executed after a error validation
        return [
            'wh_products' => 'bail|required|array_structure_create_massive|exists_from_array_create_massive:wh_product_pos,id',
            'init_datetime' => 'required|date_format:Y-m-d|after_or_equal:today',
            'finish_datetime' => 'required|date_format:Y-m-d|after_or_equal:init_datetime',
            'name' => 'required|string|max:200',
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
