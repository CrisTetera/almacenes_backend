<?php

namespace Modules\Sale\Http\Requests\SlServiceOrder;

use Illuminate\Foundation\Http\FormRequest;

class CancelServiceOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Service Order Data Request
            'comment' => 'present|max:500',
            'dte_number' => 'required|integer',
            'is_ticket' => 'required|boolean',
            'seller_user_code' => 'required|string',
            'supervisor_user_code' => 'required|string'
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
