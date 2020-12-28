<?php

namespace Modules\Pos\Tests\Unit\PosEmployeeSale;

use Tests\TestCase;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;

class PayPosEmployeeSaleElectronicTransferTest extends TestCase
{

    public const EMPLOYEE_SALE_OK = 8;

     // JSON EXAMPLE.
     public $saleJSON = [
        "employee_sale_id" => 8,
        "cashier_user_id" => 1,
        "cash_desk_id" => 1,
        // Si el total es $2.000 y el cliente paga con $3.000, se sigue
        // enviando $2.000 (El vuelto se trabaja en el frontend)
        // En este caso, para id: 1, la venta es de $261 (Siempre boleta) o $220, si es efectivo (neto)
        // Solo puede pagar con:
        // 1. Efectivo
        // 2. Combinación de estos 4: Débito, Crédito, Cheque, Crédito Interno
        "sale_payment" => [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_EFECTIVO,
                "amount_payment" => 220,
                'rounding_law' => 0
            ]
        ]
    ];

    public $tempSaleJson;

    /**
     * Reset tempSaleJSON after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempSaleJson = $this->saleJSON;
    }

    /**
     * Function to call a HTTP POST Request to pay a sale
     *
     * @return void
     */
    private function payEmployeeSale() {
        return $this->json('POST', 'api/pos_employee_sale/pay', $this->tempSaleJson);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response, $code = 500) {
        $response->assertStatus($code)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    /**
     * Should be Ok if employee sale is paid with debit, check and internal credit
     *
     * @return void
     */
    public function test_ShouldReturnOk_IfEmployeSale_IsSucessfullyPaid_WithDebitCheckAndInternalCredit()
    {
        $this->tempSaleJson['employee_sale_id'] = self::EMPLOYEE_SALE_OK;
        $this->tempSaleJson['sale_payment'] = [
            [
                "id_sale_payment_id" => SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER,
                "amount_payment" => 261,
                'transfer_number' => 424242
            ]
        ];
        $response = $this->payEmployeeSale();
        $response->assertStatus(200)
                         ->assertJson([
                             'status' => 'success',
                             'http_status_code' => 200
                         ])
                         ->assertJsonStructure([
                             'status',
                             'http_status_code',
                         ]);

        // Assert pos_employee_sale
        $this->assertDatabaseHas('pos_employee_sale',[
            'id' => $this->tempSaleJson['employee_sale_id'],
            'g_state_id' => SaleConstant::SALE_STATE_REALIZADA,
            'pos_cash_desk_id' => $this->tempSaleJson['cash_desk_id'],
            'g_cashier_user_id' => $this->tempSaleJson['cashier_user_id']
        ]);

        // Assert pos_employee_sale_pos_employee_sale_payment_type
        $this->assertDatabaseHas('pos_employee_sale_pos_employee_sale_payment_type', [
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER,
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'amount' => 261
        ]);

        // Assert pos_employee_payment_electronic_transfer
        $this->assertDatabaseHas('pos_employee_payment_electronic_transfer',[
            'pos_employee_sale_id' => $this->tempSaleJson['employee_sale_id'],
            'pos_employee_sale_payment_type_id' => SaleConstant::PAYMENT_TYPE_ELECTRONIC_TRANSFER,
            'transfer_number' => 424242
        ]);

    }
}
