<?php

namespace Modules\Sale\Http\Requests\SlSaleInvoice;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $rut
 * @property string $business_name
 * @property string $alias_name
 * @property string $core_business
 * @property array $branch_offices
 * @property integer $discount
 */
class GetLastSlSaleInvoice_OpenCashDeskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cash_desk_id' => 'required|integer|exists:pos_cash_desk,id', // Ejemplo 12345678-0
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
