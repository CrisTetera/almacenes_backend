<?php

namespace Modules\Sale\Http\Requests\SlOffer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property int $wh_product_id
 * @property int $g_branch_office_id
 * @property float $offer_price
 * @property string $init_date
 * @property string $finish_date
 */
class EditSlOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wh_product_id' => 'required|integer|min:1|exists:wh_product,id',
            'g_branch_office_id' => 'required|integer|min:1|exists:g_branch_office,id',
            'name' => 'required|string|max:200',
            'offer_price' => 'required|integer|min:0',
            'init_date' => 'required|date',
            'finish_date' => 'required|date'
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
