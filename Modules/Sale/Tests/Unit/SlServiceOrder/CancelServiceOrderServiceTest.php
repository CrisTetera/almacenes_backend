<?php

namespace Modules\Sale\Tests\Unit\SlServiceOrder;

use Tests\TestCase;
use Modules\Sale\Services\SlServiceOrder\ServiceOrderConstant;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;


class CancelServiceOrderServiceTest extends TestCase
{

    public const TICKET_SALE  = 15;
    public const INVOICE_SALE = 16;

    public $saleJSON = [
        // Service Order data:
        'comment' => 'Soy un cancel service order',
        'dte_number' => '666',
        'is_ticket' => true,
        "seller_user_code" => '875',
        "supervisor_user_code" => 'U00000008740',

        // In Service Order data:
        // In products
        // "in" => [
        //     [
        //         'product_id' => 1, // Coca cola
        //         'quantity' => 2,
        //     ],
        //     [
        //         'product_id' => 4, // Baltiloca
        //         'quantity' => 1,
        //     ],
        // ],

        // "pos_sale_type" => 1, //Ej: Boleta, 1: Boleta, 2: Factura
        // "global_discount" => 0, // En %
        // "total" => 1460, // Para validar los campos
        // "sale_detail" => [
        //     [
        //         "product_id" => 8, // Papas Kryspo
        //         "quantity" => 2,
        //         "price" => 1000,
        //         "discount" => 0, // En %
        //         'discount_unit_price' => 540, // En monto
        //         'wh_warehouse_id' => 1
        //     ]
        // ]
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
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function cancelServiceOrder() {
        return $this->json('POST', 'api/sl_service_order/cancel', $this->tempSaleJson);
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
     * Pretty dump print output
     *
     * @param Response $response
     * @return void
     */
    private function out($response)
    {
        dump(json_encode( json_decode( $response->content()), JSON_PRETTY_PRINT ));
    }


    /**
     * Test should throw exception if ticket doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTicketDoesntExistsInDatabase()
    {
        $this->tempSaleJson['dte_number'] = '666666';
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if invoice doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfInvoiceDoesntExistsInDatabase()
    {
        $this->tempSaleJson['dte_number'] = '666666';
        $this->tempSaleJson['is_ticket'] = false;
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if there is not related ticket
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNoSaleExists_Ticket()
    {
        $this->tempSaleJson['dte_number'] = '2';
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if there is not related invoice
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNoSaleExists_Invoice()
    {
        $this->tempSaleJson['dte_number'] = '2';
        $this->tempSaleJson['is_ticket'] = false;
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if sale is canceled
     *
     * @return void
     */
    public function test_ShouldThrowException_IfSaleIsCanceled()
    {
        $this->tempSaleJson['dte_number'] = '3';
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if sale is deleted
     *
     * @return void
     */
    public function test_ShouldThrowException_IfSaleIsDeleted()
    {
        $this->tempSaleJson['dte_number'] = '4';
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if sale is recently generated (ticket venta)
     *
     * @return void
     */
    public function test_ShouldThrowException_IfSaleIsRecentlyGenerated()
    {
        $this->tempSaleJson['dte_number'] = '5';
        $response = $this->cancelServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should be ok:
     * - Generate service order
     * - Cancel Sale
     * - Generate credit note in open factura
     * - Store credit note in database
     *
     * @return void
     */
    public function test_ShouldGenerate_CreditNote()
    {
        $this->tempSaleJson['dte_number'] = '777'; // ID: 2
        $response = $this->cancelServiceOrder();

        $obj = json_decode( $response->content() );

        // Assert service order was generated
        $this->assertDatabaseHas('sl_service_order', [
            'id' => $obj->service_order_id,
            'g_seller_user_id' => 1,
            'g_supervisor_user_id' => 2,
            'sl_sale_invoice_id' => null,
            'sl_sale_invoice_id2' => null,
            'sl_sale_ticket_id' => 2,
            'sl_sale_ticket_id2' => null,
            'sl_sale_credit_note_id' => $obj->sl_sale_credit_note->id,
            'sl_service_order_type_id' => ServiceOrderConstant::SERVICE_ORDER_TYPE_CANCEL,
            'comment' => $this->tempSaleJson['comment'],
            'flag_delete' => false
        ]);
        // Assert sale ticket was replaced
        $this->assertDatabaseHas('sl_sale_ticket', [
            'id' => 2,
            'number' => '777',
            'was_replaced' => true,
            'flag_delete' => false
        ]);
        // Assert Sale id Canceled.
        $this->assertDatabaseHas('pos_sale', [
            'id' => $obj->sale_id,
            'g_state_id' => SaleConstant::SALE_STATE_ANULADA,
            'flag_delete' => false
        ]);
        // Assert rollback items (wh_id: 2, items: 1, 2  stock: 1000 => 10001)
        $this->assertDatabaseHas('wh_warehouse_item', [
            'wh_warehouse_id' => 2,
            'wh_item_id' => 1,
            'stock' => 1001,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('wh_warehouse_item', [
            'wh_warehouse_id' => 2,
            'wh_item_id' => 1,
            'stock' => 1001,
            'flag_delete' => false
        ]);
        // Assert credit_note in database
        $this->assertDatabaseHas('sl_sale_credit_note', [
            'id' => $obj->sl_sale_credit_note->id,
            'emission_date' => date('Y-m-d'),
            'was_replaced' => false,
            'sl_service_order_id' => $obj->service_order_id,
            'sl_service_order_id2' => null,
            'g_company_id' => 1,
            'flag_delete' => false
        ]);
    }


}
