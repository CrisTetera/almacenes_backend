<?php

namespace Modules\Pos\Http\Requests\Pos;

use Illuminate\Foundation\Http\FormRequest;

class CreatePosTrustSalePosRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pos_sale_id' => 'nullable|integer|max:50|exist:pos_cash_desk_pos,id',
            'sl_customer_id' => 'required|integer|max:50|exist:sl_customer_pos,id',
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
