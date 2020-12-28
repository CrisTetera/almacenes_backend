<?php

namespace Modules\Sale\Http\Requests\SlOfferPos;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property float $offer_price
 * @property string $init_datetime
 * @property string $finish_datetime
 */
class EditOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_product_id' => 'required|integer|min:1|exists:wh_product_pos,id',
            'name' => 'required|string|max:200',
            'offer_price' => 'required|integer|min:0',
            'init_datetime' => 'required|date',
            'finish_datetime' => 'required|date'
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
