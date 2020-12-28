<?php

namespace Modules\Sale\Tests\Unit\SlServiceOrder;

use Tests\TestCase;
use Modules\Sale\Services\SlServiceOrder\ServiceOrderConstant;


class ChangeServiceOrderServiceTest extends TestCase
{

    public $saleJSON = [
        // Service Order data:
        'comment' => 'Soy un service order',
        'dte_number' => '666',
        'is_ticket' => true,
        "seller_user_code" => '875',
        "supervisor_user_code" => 'U00000008740',

        // In Service Order data:
        // In products
        "in" => [
            [
                'product_id' => 1, // Coca cola
                'quantity' => 2,
            ],
            [
                'product_id' => 4, // Baltiloca
                'quantity' => 1,
            ],
        ],

        // Sale Data
        // Solo si ya está, si no se envía null
        "customer_id" => 1,
        // Si no está se envía:
        'customer' => null,
        'sucursal_id' => 1,
        "pos_sale_type" => 1, //Ej: Boleta, 1: Boleta, 2: Factura
        "global_discount" => 0, // En %
        "global_discount_amount" => 540,
        "total" => 1460, // Para validar los campos
        "sale_detail" => [
            [
                "product_id" => 8, // Papas Kryspo
                "quantity" => 2,
                "price" => 1000,
                "discount" => 0, // En %
                'discount_unit_price' => 0, // En monto
                'wh_warehouse_id' => 1
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
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function changeServiceOrder() {
        return $this->json('POST', 'api/sl_service_order/change', $this->tempSaleJson);
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
     * Test should throw exception if no data is sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNoDataIsSended()
    {
        $this->tempSaleJson = [];
        $response = $this->changeServiceOrder();
        $response->assertStatus(422)
                ->assertJson([
                    'status' => 'error',
                    'http_status_code' => 422
                ])
                ->assertJsonStructure([
                    'status',
                    'http_status_code',
                    'errors' => [
                        'comment',
                        'dte_number',
                        'is_ticket',
                        'in',
                        'sucursal_id',
                        'pos_sale_type',
                        'global_discount',
                        'total',
                        'sale_detail'
                    ]
                ]);
    }

    /**
     * Test should throw exception if ticket doesn't exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTicketDoesntExistsInDatabase()
    {
        $this->tempSaleJson['dte_number'] = '666666';
        $response = $this->changeServiceOrder();
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
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if total to pay is lower than total product to change.
     * For example, in this case the product to change amount is $540 ($180 two Cocacolas and $360 one baltiloca)
     * And new sale has a ticket total of $400.
     * In this case the test should throw an exception
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTotalToPay_IsLowerThanTotalProductToChange_WithTicket()
    {
        $this->tempSaleJson["total"] = 400;
        $this->tempSaleJson["sale_detail"] = [
            [
                "product_id" => 8, // Papas Kryspo
                "quantity" => 2,
                "price" => 200,
                "discount" => 0, // En %
                'discount_unit_price' => 0, // En monto
                'wh_warehouse_id' => 1
            ]
        ];
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if total to pay is lower than total product to change.
     * For example, in this case the product to change amount is $540 ($180 two Cocacolas and $360 one baltiloca)
     * And new sale has a ticket total of $400.
     * In this case the test should throw an exception
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTotalToPay_IsLowerThanTotalProductToChange_WithInvoice()
    {
        $this->tempSaleJson["is_ticket"] = false;
        $this->tempSaleJson["total"] = 400;
        $this->tempSaleJson["sale_detail"] = [
            [
                "product_id" => 8, // Papas Kryspo
                "quantity" => 2,
                "price" => 200,
                "discount" => 0, // En %
                'discount_unit_price' => 0, // En monto
                'wh_warehouse_id' => 1
            ]
        ];
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if product is not found
     *
     * @return void
     */
    public function test_ShouldThrowException_IfProductDoesntExistsInDatabase()
    {
        $this->tempSaleJson['in'][0]['product_id'] = 99999;
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if product to change is not present in ticket/invoice
     *
     * @return void
     */
    public function test_ShouldThrowException_IfProductIsNotPresent_InTicketOrInvoice()
    {
        $this->tempSaleJson['in'][0]['product_id'] = 10;
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if quantity of a product to change is greater than ticket/invoice quantity of same product
     *
     * @return void
     */
    public function test_ShouldThrowException_IfProductQuantityIsGreaterThan_QuantityInTicketOrInvoice()
    {
        $this->tempSaleJson['in'][0]['quantity'] = 10;
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test Should be ok if you change a ticket
     *
     * @return void
     */
    public function test_ShouldBeOk_ToChangeTicket()
    {
        $response = $this->changeServiceOrder();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                    'status',
                    'http_status_code',
                    'service_order_id',
                    'sale_id',
                    'sale_id_formatted'
                 ]);
        $obj = json_decode( $response->content() );
        // Assert pos_sale (this test is already in GenerateSaleTest, so only id of sale is tested)
        $this->assertDatabaseHas('pos_sale',[
            'id' => $obj->sale_id
        ]);
        // Assert sl_service_order
        $this->assertDatabaseHas('sl_service_order',[
            'id' => $obj->service_order_id,
            'g_seller_user_id' => 1,
            'g_supervisor_user_id' => 2,
            'sl_sale_invoice_id' => null,
            'sl_sale_invoice_id2' => null,
            'sl_sale_ticket_id' => 1,
            'sl_sale_ticket_id2' => null,
            'sl_sale_credit_note_id' => null,
            'sl_service_order_type_id' => ServiceOrderConstant::SERVICE_ORDER_TYPE_CHANGE,
            'comment' => $this->tempSaleJson['comment'] ? $this->tempSaleJson['comment'] : '',
            'flag_delete' => false
        ]);

        // Assert sl_service_order_product_change
        $this->assertDatabaseHas('sl_service_order_product_change',[
            'sl_service_order_id' => $obj->service_order_id,
            'wh_product_id' => 1,
            'quantity' => 2,
            'movement_type' => ServiceOrderConstant::CHANGE_IN,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('sl_service_order_product_change',[
            'sl_service_order_id' => $obj->service_order_id,
            'wh_product_id' => 4,
            'quantity' => 1,
            'movement_type' => ServiceOrderConstant::CHANGE_IN,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('sl_service_order_product_change',[
            'sl_service_order_id' => $obj->service_order_id,
            'wh_product_id' => 8,
            'quantity' => 2,
            'movement_type' => ServiceOrderConstant::CHANGE_OUT,
            'flag_delete' => false
        ]);
        // Assert wh_warehouse_item (waste_warehouse to test is id: 3)
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 3,
            'wh_item_id' => 1,
            'stock' => 2,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 3,
            'wh_item_id' => 4,
            'stock' => 1,
            'flag_delete' => false
        ]);
        // Assert sl_sale_ticket was_replaced to true
        $this->assertDatabaseHas('sl_sale_ticket',[
            'id' => 1,
            'was_replaced' => true
        ]);
    }

    /**
     * Test should be ok if you change an invoice
     *
     * @return void
     */
    public function test_ShouldBeOk_ToChangeInvoice()
    {
        $this->tempSaleJson['is_ticket'] = false;
        $response = $this->changeServiceOrder();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                    'status',
                    'http_status_code',
                    'service_order_id',
                    'sale_id',
                    'sale_id_formatted'
                 ]);
        $obj = json_decode( $response->content() );
        // Assert pos_sale (this test is already in GenerateSaleTest, so only id of sale is tested)
        $this->assertDatabaseHas('pos_sale',[
            'id' => $obj->sale_id
        ]);
        // Assert sl_service_order
        $this->assertDatabaseHas('sl_service_order',[
            'id' => $obj->service_order_id,
            'g_seller_user_id' => 1,
            'g_supervisor_user_id' => 2,
            'sl_sale_invoice_id' => 1,
            'sl_sale_invoice_id2' => null,
            'sl_sale_ticket_id' => null,
            'sl_sale_ticket_id2' => null,
            'sl_sale_credit_note_id' => null,
            'sl_service_order_type_id' => ServiceOrderConstant::SERVICE_ORDER_TYPE_CHANGE,
            'comment' => $this->tempSaleJson['comment'] ? $this->tempSaleJson['comment'] : '',
            'flag_delete' => false
        ]);

        // Assert sl_service_order_product_change
        $this->assertDatabaseHas('sl_service_order_product_change',[
            'sl_service_order_id' => $obj->service_order_id,
            'wh_product_id' => 1,
            'quantity' => 2,
            'movement_type' => ServiceOrderConstant::CHANGE_IN,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('sl_service_order_product_change',[
            'sl_service_order_id' => $obj->service_order_id,
            'wh_product_id' => 4,
            'quantity' => 1,
            'movement_type' => ServiceOrderConstant::CHANGE_IN,
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('sl_service_order_product_change',[
            'sl_service_order_id' => $obj->service_order_id,
            'wh_product_id' => 8,
            'quantity' => 2,
            'movement_type' => ServiceOrderConstant::CHANGE_OUT,
            'flag_delete' => false
        ]);
        // Assert wh_warehouse_item (waste_warehouse to test is id: 3)
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 3,
            'wh_item_id' => 1,
            'stock' => 4, // + 2 for previous ticket test
            'flag_delete' => false
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 3,
            'wh_item_id' => 4,
            'stock' => 2, // + 1 for previous ticket test
            'flag_delete' => false
        ]);
        // Assert sl_sale_invoice was_replaced to true
        $this->assertDatabaseHas('sl_sale_invoice',[
            'id' => 1,
            'was_replaced' => true
        ]);
    }

    /**
     * Test should throw exception if ticket was replaced
     *
     * @return void
     */
    public function test_ShouldThrowException_IfTicketWasReplaced()
    {
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if invoice was replaced
     *
     * @return void
     */
    public function test_ShouldThrowException_IfInvoiceWasReplaced()
    {
        $this->tempSaleJson['is_ticket'] = false;
        $response = $this->changeServiceOrder();
        $this->assertError($response);
    }

}
