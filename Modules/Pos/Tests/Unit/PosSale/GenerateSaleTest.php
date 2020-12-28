<?php

namespace Modules\Pos\Tests\Unit\PosSale;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Services\PosSale\Entities\SaleConstant;
use Modules\General\Entities\GUser;

class GenerateSaleTest extends TestCase
{
    // JSON EXAMPLE.
    public $saleJSON = [
        // Se reciben los code del vendedor y del supervisor en caso de
        "seller_user_code" => 874,
        "supervisor_user_code" => null,
        // Solo si ya está, si no se envía null en ambos casos
        "customer_id" => 1,
        "default_branch_office_id" => 1, // ID de la sucursal del cliente

        "purchase_order" => null, // Opcional, solo si es factura

        // Si no está se envía:
        'customer' => null,
        'sucursal_id' => 1,
        "pos_sale_type" => 1, //Ej: Boleta
        "global_discount" => 10, // En %
        "global_discount_amount" => 0, // En monto
        "total" => 252, // Para validar los campos
        "sale_detail" => [
            [
                "product_id" => 1,
                "quantity" => 1,
                "price" => 100,
                "discount" => 10, // En %
                'discount_unit_price' => 0, // En monto
                'wh_warehouse_id' => 1
            ],
            [
                "product_id" => 2,
                "quantity" => 1,
                "price" => 200,
                "discount" => 0,
                'discount_unit_price' => 10, // En monto
                'wh_warehouse_id' => 1
            ]
        ]
    ];

    public $tempSaleJson;

    /**
     * Constants
     */
    // GUser Ids of differents sellers (Defined in Seeds)
    private const G_USER_NORMAL_SELLER_ID = 6; 
    private const G_USER_GROUND_SELLER_ID = 1;
    private const G_USER_CALL_CENTER_SELLER_ID = 10;
    // User logged
    private const ID_USER = 1;


    /**
     * Reset tempSaleJSON after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempSaleJson = $this->saleJSON;

        // Like a Logged User
        $user = GUser::find(self::ID_USER);
        $this->actingAs($user, 'api');
    }

    /**
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function newSale() {
        return $this->json('POST', 'api/pos_sale', $this->tempSaleJson);
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response) {
        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_save_sale()
    {
        $response = $this->newSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('pos_sale',[
            'id' => $obj->sale_id,
            'ticket_total' => 252,
            'invoice_total' => 252,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 10,
            'new_net_subtotal' => 212,
            'iva' => 40,
            'exent_total' => 0,
            'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
            'sl_customer_id' => $this->tempSaleJson['customer_id'],
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
           'pos_sale_id' => $obj->sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 1
        ]);
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
            'pos_sale_id' => $obj->sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 1
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => 999
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 999
        ]);
    }

    /**
     * Should add customer if customer_id is not sended
     *
     * @return void
     */
    public function test_saveSale_WithCustomerData_AndInvoice()
    {
        $this->tempSaleJson['customer_id'] = null;
        $this->tempSaleJson['pos_sale_type'] = SaleConstant::INVOICE;
        $this->tempSaleJson['purchase_order'] = 123123123;
        $this->tempSaleJson['default_branch_office_id'] = null;
        $this->tempSaleJson['default_branch_office_index'] = 2;
        $this->tempSaleJson['customer'] = [
            'rut' => '11116848-2', // Ejemplo 12345678-0
            'business_name' => 'InnLAB S.A',  // Razón social
            'alias_name' => 'InnLAB', // Nombre / Nombre de Fantasía
            'core_business' => 'Tecnologías de la Información', // Giro
            'branch_offices' => [
                [
                    'address' => 'Ramon Solar 1 #423',
                    'phone' => '+56 9 8888 8888', // Opcional
                    'email' => 'contacto@dgz.cl',
                    'g_commune_id' => 36, // Ovalle
                    'default_branch_office' => true
                ],
                [
                    'address' => 'Ramon Solar 2 #423',
                    'phone' => '+56 9 8888 8888', // Opcional
                    'email' => 'contacto@dgz.cl',
                    'g_commune_id' => 36, // Ovalle
                    'default_branch_office' => false
                ],
                [
                    'address' => 'Ramon Solar 3 #423',
                    'phone' => '+56 9 8888 8888', // Opcional
                    'email' => 'contacto@dgz.cl',
                    'g_commune_id' => 36, // Ovalle
                    'default_branch_office' => false
                ],
                [
                    'address' => 'Ramon Solar 4 #423',
                    'phone' => '+56 9 8888 8888', // Opcional
                    'email' => 'contacto@dgz.cl',
                    'g_commune_id' => 36, // Ovalle
                    'default_branch_office' => false
                ]
            ]
        ];
        $response = $this->newSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert New Customer
        $this->assertDatabaseHas('sl_customer', [
            'rut' => $this->tempSaleJson['customer']['rut'],
            'business_name' => $this->tempSaleJson['customer']['business_name'],
            'alias_name' => $this->tempSaleJson['customer']['alias_name'],
            'core_business' => $this->tempSaleJson['customer']['core_business'],
            'flag_delete' => false
        ]);

        // Assert Sale
        $this->assertDatabaseHas('pos_sale',[
            'id' => $obj->sale_id,
            'ticket_total' => 252,
            'invoice_total' => 252,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 10,
            'new_net_subtotal' => 212,
            'iva' => 40,
            'exent_total' => 0,
            'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'close_sale_datetime' => null,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
           'pos_sale_id' => $obj->sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 1
        ]);
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
            'pos_sale_id' => $obj->sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 1
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => 998
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 998
        ]);
        // Asser pos sale invoice data
        $this->assertDatabaseHas('pos_sale_invoice_data', [
            'pos_sale_id' => $obj->sale_id,
            'purchase_order' => $this->tempSaleJson['purchase_order'],
            'flag_delete' => false
        ]);
    }

    /**
     * Should add customer if customer_id is not sended
     *
     * @return void
     */
    public function test_saveSale_WithGlobalDiscountAmount()
    {
        $this->tempSaleJson['total'] = 180;
        $this->tempSaleJson['global_discount'] = 0;
        $this->tempSaleJson['global_discount_amount'] = 100;
        $response = $this->newSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('pos_sale',[
            'id' => $obj->sale_id,
            'ticket_total' => 180,
            'invoice_total' => 181,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_amount' => 100,
            'new_net_subtotal' => 152,
            'iva' => 29,
            'exent_total' => 0,
            'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
            'g_branch_office_id' => $this->tempSaleJson['sucursal_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'close_sale_datetime' => null,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
           'pos_sale_id' => $obj->sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 1
        ]);
        $this->assertDatabaseHas('pos_sale_stock_reservation', [
            'pos_sale_id' => $obj->sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 1
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => 997
        ]);
        $this->assertDatabaseHas('wh_warehouse_item',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 997
        ]);
    }

    /**
     * Save normal sale
     *
     * @return void
     */
    public function test_saveSale_NormalOriginSale()
    {
        $this->tempSaleJson['g_seller_user_id'] = self::G_USER_NORMAL_SELLER_ID;
        $response = $this->newSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Pos Origin Sale in PosSale
        $this->assertDatabaseHas('pos_sale', [
           'id' => $obj->sale_id,
           'pos_origin_sale_id' => SaleConstant::ORIGIN_SALE_NORMAL_ID,
        ]);
    }

    /**
     * Save Ground sale
     *
     * @return void
     */
    public function test_saveSale_GroundOriginSale()
    {
        $this->tempSaleJson['g_seller_user_id'] = self::G_USER_GROUND_SELLER_ID;
        $response = $this->newSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Pos Origin Sale in PosSale
        $this->assertDatabaseHas('pos_sale', [
            'id' => $obj->sale_id,
            'pos_origin_sale_id' => SaleConstant::ORIGIN_SALE_GROUND_ID,
        ]);
    }

    /**
     * Save Call Center sale
     *
     * @return void
     */
    public function test_saveSale_CallCenterOriginSale()
    {
        $this->tempSaleJson['g_seller_user_id'] = self::G_USER_CALL_CENTER_SELLER_ID;
        $response = $this->newSale();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Pos Origin Sale in PosSale
        $this->assertDatabaseHas('pos_sale', [
            'id' => $obj->sale_id,
            'pos_origin_sale_id' => SaleConstant::ORIGIN_SALE_CALL_CENTER_ID,
        ]);
    }


    /**
     * Should throw an exception if global sale data has a bad data
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleDataIsBad() {
        $this->tempSaleJson['total'] = 5000;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw an exception if sale has no products
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleHasNoProducts() {
        $this->tempSaleJson['sale_detail'] = [];
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw an exception, if customer doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfCustomer_DoesntExists() {
        $this->tempSaleJson['customer_id'] = -1;
        $this->tempSaleJson['customer'] = null;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if branch office doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfBranchOffice_DoesntExists() {
        $this->tempSaleJson['sucursal_id'] = -1;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if sale type (ticket, invoice) doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleType_DoesntExists() {
        $this->tempSaleJson['pos_sale_type'] = -1;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if not customer and invoice was sended
     *
     * @return void
     */
    public function test_shouldThrowException_IfNotCustomerAndInvoiceWasSended() {
        $this->tempSaleJson['customer_id'] = -1;
        $this->tempSaleJson['pos_sale_type'] = 2;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product doesn't exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductDoesntExists() {
        $this->tempSaleJson['sale_detail'][1]['product_id'] = -1;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product has no price
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductHasNoPrice() {
        $this->tempSaleJson['sale_detail'][1]['product_id'] = 3;
        $response = $this->newSale();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product is not salable
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductIsNotSalable() {
        $this->tempSaleJson['sale_detail'][0]['product_id'] = 3;
        $response = $this->newSale();
        $this->assertError($response);
    }

}
