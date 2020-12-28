<?php

namespace Modules\Warehouse\Http\Requests\WhTransferBetweenWarehouse;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $description
 * @property array $details
 */
class ReceiveTransferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'nullable|string|max:500',

            'details' => 'required|array|min:1',
            'details.*.wh_product_id' => 'required|integer|min:1|exists:wh_product,id,flag_delete,false',
            'details.*.state' => 'required|integer|in:-1,0,1'
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
