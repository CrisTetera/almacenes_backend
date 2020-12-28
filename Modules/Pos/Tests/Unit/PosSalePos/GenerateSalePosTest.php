<?php

namespace Modules\Pos\Tests\Unit\PosSalePos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Pos\Services\PosSalePos\Entities\SaleConstant;
use Modules\General\Entities\GUserPos;
use App\Helpers\CustomTestCase;

class GenerateSalePosTest extends CustomTestCase
{
    // JSON EXAMPLE.
    public $saleJSON = [
        /* Se reciben los code del vendedor y del supervisor en caso de
        "seller_user_code" => 874,
        "supervisor_user_code" => null,*/
        // Solo si ya está, si no se envía null en ambos casos
        
        //"default_branch_office_id" => 1, // ID de la sucursal del cliente

        //"purchase_order" => null, // Opcional, solo si es factura

        // Si no está se envía:
        //'customer' => null,
        "customer_id" => 1,
        "pos_sale_type" => 1, //Ej: 1: Boleta , 2: Factura 
        "global_discount_percentage" => 0, //10, // En %
        "global_discount_amount" => 0, // En monto
        "total" => 1200, //252, // Para validar los campos
        //'pos_cash_desk_id' => 1,
        "sale_detail" => [
            [
                "wh_product_id" => 15,//1,
                "quantity" => 1,
                "price" => 1200,//100,
                "discount_percentage" => 0,//10, // En %
                'discount_amount' => 0, // En monto
                'wh_warehouse_id' => 1
            ],
            // [
            //     "wh_product_id" => 2,
            //     "quantity" => 1,
            //     "price" => 200,
            //     "discount_percentage" => 0, // En %
            //     'discount_amount' => 10, // En monto
            //     'wh_warehouse_id' => 1
            // ]
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
    protected function setUp() : void {
        parent::setUp();
        $this->tempSaleJson = $this->saleJSON;

        // Like a Logged User
        $user = GUserPos::find(self::ID_USER);
        $this->actingAs($user, 'api');
    }

    /**
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function newSale() {
        return $this->json('POST', 'api/pos_sale_pos', $this->tempSaleJson);
    }

    /**
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function newTrustSale() {
        return $this->json('POST', 'api/pos_trust_sale_pos', $this->tempSaleJson);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_save_sale()
    {
        $response = $this->newSale();
        // dump($response);
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'pos_sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());
        // $this->dump($response);

        // Assert Sale
        $this->assertDatabaseHas('pos_sale_pos',[
            // 'id' => $obj->sale_id,
            'ticket_total' => 1200,//252,
            'invoice_total' => 1200,//252,
            'net_subtotal' => 0,//236,
            //'pos_cash_desk_id' => $this->tempSaleJson['pos_cash_desk_id'],
            'global_discount_percentage' => 0,//10,
            //'global_discount_amount' => 0,
            'new_net_subtotal' => 0,//212,
            'iva' => 0,//40,
            'exempt_total' => 1200,//0,
            'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
            'sl_customer_id' => $this->tempSaleJson['customer_id'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_pos', [
            // 'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['wh_product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 1200,//84.03,
            'net_subtotal' => 1200,//84,
            'discount_percentage' => $this->saleJSON['sale_detail'][0]['discount_percentage'],
            'discount_amount' => $this->saleJSON['sale_detail'][0]['discount_amount'],
            'new_net_subtotal' => 1200,//76,
            'total' => 1200,//90
        ]);
        // $this->assertDatabaseHas('pos_detail_pos', [
        //     // 'pos_sale_id' => $obj->sale_id,
        //     'wh_product_id' => $this->saleJSON['sale_detail'][1]['wh_product_id'],
        //     'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
        //     'price' => 200,
        //     'net_price' => 168.07,
        //     'net_subtotal' =>168,
        //     'discount_percentage' => $this->saleJSON['sale_detail'][1]['discount_percentage'],
        //     'discount_amount' => $this->saleJSON['sale_detail'][1]['discount_amount'],
        //     'new_net_subtotal' => 160,
        //     'total' => 190
        // ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
        //    'pos_sale_id' => $obj->sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 10,//1,
           'stock' => 1
        ]);
        // $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
        //     // 'pos_sale_id' => $obj->sale_id,
        //     'wh_warehouse_id' => 1,
        //     'wh_item_id' => 2,
        //     'stock' => 1
        // ]);
        
        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_item_stock_pos',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 10,//1,
            'stock' => 84//502
        ]);
        // $this->assertDatabaseHas('wh_item_stock_pos',[
        //     'wh_warehouse_id' => 1,
        //     'wh_item_id' => 2,
        //     'stock' => 998
        // ]);
    }

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function test_save_trust_sale()
    // {
    //     $response = $this->newTrustSale();
    //     $this->dump($response);
    //     $response->assertStatus(201)
    //              ->assertJson([
    //                  'status' => 'success',
    //                  'http_status_code' => 201
    //              ])
    //              ->assertJsonStructure([
    //                  'status',
    //                  'http_status_code',
    //                  'pos_sale_id',
    //                  'sale_id_formatted'
    //              ]);
    //     $obj = json_decode($response->content());
    //     $this->dump($response);
    //     // Assert Sale
    //     $this->assertDatabaseHas('pos_sale_pos',[
    //         // 'id' => $obj->sale_id,
    //         'ticket_total' => 252,
    //         'invoice_total' => 252,
    //         'net_subtotal' => 236,
    //         //'pos_cash_desk_id' => $this->tempSaleJson['pos_cash_desk_id'],
    //         'global_discount_percentage' => 10,
    //         //'global_discount_amount' => 0,
    //         'new_net_subtotal' => 212,
    //         'iva' => 40,
    //         'exempt_total' => 0,
    //         'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
    //         'sl_customer_id' => $this->tempSaleJson['customer_id'],
    //         'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
    //         'flag_delete' => false
    //     ]);

    //     // Assert Detalle
    //     $this->assertDatabaseHas('pos_detail_pos', [
    //         // 'pos_sale_id' => $obj->sale_id,
    //         'wh_product_id' => $this->saleJSON['sale_detail'][0]['wh_product_id'],
    //         'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
    //         'price' => $this->saleJSON['sale_detail'][0]['price'],
    //         'net_price' => 84.03,
    //         'net_subtotal' =>84,
    //         'discount_percentage' => $this->saleJSON['sale_detail'][0]['discount_percentage'],
    //         'discount_amount' => $this->saleJSON['sale_detail'][0]['discount_amount'],
    //         'new_net_subtotal' => 76,
    //         'total' => 90
    //     ]);
    //     $this->assertDatabaseHas('pos_detail_pos', [
    //         // 'pos_sale_id' => $obj->sale_id,
    //         'wh_product_id' => $this->saleJSON['sale_detail'][1]['wh_product_id'],
    //         'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
    //         'price' => 200,
    //         'net_price' => 168.07,
    //         'net_subtotal' =>168,
    //         'discount_percentage' => $this->saleJSON['sale_detail'][1]['discount_percentage'],
    //         'discount_amount' => $this->saleJSON['sale_detail'][1]['discount_amount'],
    //         'new_net_subtotal' => 160,
    //         'total' => 190
    //     ]);
    //     // $this->assertDatabaseHas('pos_trust_sale_pos',[
    //     //     'pos_sale_id' => $obj->sale_id,
    //     //     'sl_customer_pos' => $this->trustSaleJSON['customer_id'],
    //     // ]);

    //     // Assert Reserva
    //     $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
    //     //    'pos_sale_id' => $obj->sale_id,
    //        'wh_warehouse_id' => 1,
    //        'wh_item_id' => 1,
    //        'stock' => 1
    //     ]);
    //     $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
    //         // 'pos_sale_id' => $obj->sale_id,
    //         'wh_warehouse_id' => 1,
    //         'wh_item_id' => 2,
    //         'stock' => 1
    //     ]);
        
    //     // Assert Warehouse Item
    //     $this->assertDatabaseHas('wh_item_stock_pos',[
    //         'wh_warehouse_id' => 1,
    //         'wh_item_id' => 1,
    //         'stock' => 999
    //     ]);
    //     $this->assertDatabaseHas('wh_item_stock_pos',[
    //         'wh_warehouse_id' => 1,
    //         'wh_item_id' => 2,
    //         'stock' => 999
    //     ]); 
    // }

    // /**
    //  * Should add customer if customer_id is not sended
    //  *
    //  * @return void
    //  */
    // public function test_saveSale_WithCustomerData_AndInvoice()
    // {
    //     $this->tempSaleJson['customer_id'] = null;
    //     $this->tempSaleJson['pos_sale_type'] = SaleConstant::INVOICE;
    //     $this->tempSaleJson['customer'] = [
    //         'rut' => '11116848-2', // Ejemplo 12345678-0
    //         'business_name' => 'InnLAB S.A',  // Razón social
    //         'alias_name' => 'InnLAB', // Nombre / Nombre de Fantasía
    //         'commercial_business' => 'Tecnologías de la Información', // Giro
    //         'address' => 'Ramon Solar 1 #423',
    //         'phone_number' => '+56 9 8888 8888', // Opcional
    //         'email' => 'contacto@dgz.cl',
    //         'g_commune_id' => 36, // Ovalle
                
            
    //     ];
    //     $response = $this->newSale();
    //     //$this->dump($response);
    //     $response->assertStatus(201)
    //              ->assertJson([
    //                  'status' => 'success',
    //                  'http_status_code' => 201
    //              ])
    //              ->assertJsonStructure([
    //                  'status',
    //                  'http_status_code',
    //                  'pos_sale_id',
    //                  'sale_id_formatted'
    //              ]);
    //     $obj = json_decode($response->content());

    //     // Assert New Customer
    //     $this->assertDatabaseHas('sl_customer_pos', [
    //         'rut' => $this->tempSaleJson['customer']['rut'],
    //         'business_name' => $this->tempSaleJson['customer']['business_name'],
    //         'alias_name' => $this->tempSaleJson['customer']['alias_name'],
    //         'commercial_business' => $this->tempSaleJson['customer']['commercial_business'],
    //         'flag_delete' => false
    //     ]);

    //     // Assert Sale
    //     $this->assertDatabaseHas('pos_sale_pos',[
    //         'id' => $obj->sale_id,
    //         'ticket_total' => 252,
    //         'invoice_total' => 252,
    //         'net_subtotal' => 236,
    //         'global_discount_percentage' => 10,
    //         'new_net_subtotal' => 212,
    //         'iva' => 40,
    //         'exempt_total' => 0,
    //         'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
    //         'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
    //         'close_sale_datetime' => null,
    //         'flag_delete' => false
    //     ]);

    //     // Assert Detalle
    //     $this->assertDatabaseHas('pos_detail_pos', [
    //         'pos_sale_id' => $obj->sale_id,
    //         'wh_product_id' => $this->saleJSON['sale_detail'][0]['wh_product_id'],
    //         'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
    //         'price' => $this->saleJSON['sale_detail'][0]['price'],
    //         'net_price' => 84.03,
    //         'net_subtotal' =>84,
    //         'discount_percentage' => 10,
    //         'discount_amount' => 0,
    //         'new_net_subtotal' => 76,
    //         'total' => 90
    //     ]);
    //     $this->assertDatabaseHas('pos_detail_pos', [
    //         'pos_sale_id' => $obj->sale_id,
    //         'wh_product_id' => $this->saleJSON['sale_detail'][1]['wh_product_id'],
    //         'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
    //         'price' => 200,
    //         'net_price' => 168.07,
    //         'net_subtotal' =>168,
    //         'discount_percentage' => 0,
    //         'discount_amount' => 10,
    //         'new_net_subtotal' => 160,
    //         'total' => 190
    //     ]);

    //     //Assert Reserva
    //     $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
    //        'pos_sale_id' => $obj->sale_id,
    //        'wh_warehouse_id' => 1,
    //        'wh_item_id' => 1,
    //        'stock' => 1
    //     ]);
    //     $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
    //         'pos_sale_id' => $obj->sale_id,
    //         'wh_warehouse_id' => 1,
    //         'wh_item_id' => 2,
    //         'stock' => 1
    //     ]);

    //     // Assert Warehouse Item
    //     $this->assertDatabaseHas('wh_item_stock_pos',[
    //         'wh_warehouse_id' => 1,
    //         'wh_item_id' => 1,
    //         'stock' => 998
    //     ]);
    //     $this->assertDatabaseHas('wh_item_stock_pos',[
    //         'wh_warehouse_id' => 1,
    //         'wh_item_id' => 2,
    //         'stock' => 998
    //     ]);/*
    //     // Asser pos sale invoice data
    //     $this->assertDatabaseHas('pos_sale_invoice_data', [
    //         'pos_sale_id' => $obj->sale_id,
    //         'purchase_order' => $this->tempSaleJson['purchase_order'],
    //         'flag_delete' => false
    //     ]);*/
    // }

    
    /*
     * Should add sale with global discount amount
     *
     * @return void
     *
    public function test_saveSale_WithGlobalDiscountAmount()
    {
        $this->tempSaleJson['total'] = 180;
        $this->tempSaleJson['global_discount_percentage'] = 0;
        $this->tempSaleJson['global_discount_amount'] = 100;
        $response = $this->newSale();
        $this->dump($response);
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'pos_sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('pos_sale_pos',[
            'id' => $obj->sale_id,
            'ticket_total' => 180,
            'invoice_total' => 181,
            'net_subtotal' => 236,
            'global_discount_percentage' => $this->tempSaleJson['global_discount_percentage'] = 0,
            'global_discount_amount' =>  $this->tempSaleJson['global_discount_amount'] = 100,
            'new_net_subtotal' => 152,
            'iva' => 29,
            'exempt_total' => 0,
            'pos_sale_type_id' => $this->tempSaleJson['pos_sale_type'],
            'g_state_id' => SaleConstant::SALE_STATE_VALE_VENTA,
            'close_sale_datetime' => null,
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][0]['wh_product_id'],
            'quantity' => $this->saleJSON['sale_detail'][0]['quantity'],
            'price' => $this->saleJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_percentage' => $this->saleJSON['sale_detail'][0]['discount_percentage'],
            'discount_amount' => $this->saleJSON['sale_detail'][0]['discount_amount'],
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('pos_detail_sale', [
            'pos_sale_id' => $obj->sale_id,
            'wh_product_id' => $this->saleJSON['sale_detail'][1]['wh_product_id'],
            'quantity' => $this->saleJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_percentage' => $this->saleJSON['sale_detail'][1]['discount_percentage'],
            'discount_amount' => $this->saleJSON['sale_detail'][1]['discount_amount'],
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

        // Assert Reserva
        $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
           'pos_sale_id' => $obj->sale_id,
           'wh_warehouse_id' => 1,
           'wh_item_id' => 1,
           'stock' => 1
        ]);
        $this->assertDatabaseHas('pos_sale_stock_reservation_pos', [
            'pos_sale_id' => $obj->sale_id,
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 1
        ]);

        // Assert Warehouse Item
        $this->assertDatabaseHas('wh_item_stock_pos',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 1,
            'stock' => 997
        ]);
        $this->assertDatabaseHas('wh_item_stock_pos',[
            'wh_warehouse_id' => 1,
            'wh_item_id' => 2,
            'stock' => 997
        ]);
    }*/

    /*
     * Save normal sale
     *
     * @return void
     *
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
                     'pos_sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Pos Origin Sale in PosSale
        $this->assertDatabaseHas('pos_sale', [
           'id' => $obj->sale_id,
           'pos_origin_sale_id' => SaleConstant::ORIGIN_SALE_NORMAL_ID,
        ]);
    }*/

    /*
     * Save Ground sale
     *
     * @return void
     *
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
                     'pos_sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Pos Origin Sale in PosSale
        $this->assertDatabaseHas('pos_sale', [
            'id' => $obj->sale_id,
            'pos_origin_sale_id' => SaleConstant::ORIGIN_SALE_GROUND_ID,
        ]);
    }*/

    /*
     * Save Call Center sale
     *
     * @return void
     *
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
                     'pos_sale_id',
                     'sale_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Pos Origin Sale in PosSale
        $this->assertDatabaseHas('pos_sale', [
            'id' => $obj->sale_id,
            'pos_origin_sale_id' => SaleConstant::ORIGIN_SALE_CALL_CENTER_ID,
        ]);
    }*/


    // /**
    //  * Should throw an exception if global sale data has a bad data
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSaleDataIsBad() {
    //     $this->tempSaleJson['total'] = 5000;
    //     $response = $this->newSale();
    //     $this->assertError($response);
    // }

    // /**
    //  * Should throw an exception if sale has no products
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSaleHasNoProducts() {
    //     $this->tempSaleJson['sale_detail'] = [];
    //     $response = $this->newSale();
    //     $this->assertError($response);
    // }

    // /**
    //  * Should throw an exception, if customer doesnt exists in database
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfCustomer_DoesntExists() {
    //     $this->tempSaleJson['customer_id'] = -1;
    //     $this->tempSaleJson['customer'] = null;
    //     $response = $this->newSale();
    //     $this->assertError($response);
    // }

    // /**
    //  * Should throw exception, if sale type (ticket, invoice) doesnt exists in database
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfSaleType_DoesntExists() {
    //     $this->tempSaleJson['pos_sale_type'] = -1;
    //     $response = $this->newSale();
    //     $this->assertError($response);
    // }

    // /*
    //  * Should throw exception if not customer and invoice was sended
    //  *
    //  * @return void
    //  *
    // public function test_shouldThrowException_IfNotCustomerAndInvoiceWasSended() {
    //     $this->tempSaleJson['customer_id'] = -1;
    //     $this->tempSaleJson['pos_sale_type'] = 2;
    //     $response = $this->newSale();
    //     $this->assertError($response);
    // }*/

    // /**
    //  * Should throw exception if product doesn't exists in database
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfProductDoesntExists() {
    //     $this->tempSaleJson['sale_detail'][1]['wh_product_id'] = -1;
    //     $response = $this->newSale();
    //     $this->assertError($response);
    // }

    // /**
    //  * Should throw exception if product has no price
    //  *
    //  * @return void
    //  */
    // public function test_shouldThrowException_IfProductHasNoPrice() {
    //     $this->tempSaleJson['sale_detail'][1]['wh_product_id'] = 3;
    //     $response = $this->newSale();
    //     $this->assertError($response);
    //     dump($response);
    // }

}
