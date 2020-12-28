<?php

namespace Modules\Sale\Tests\Unit\SlSaleQuotation;

use Tests\TestCase;


class GenerateSaleQuotationTest extends TestCase
{

    // JSON EXAMPLE.
    public $QuotationJSON = [
        // Solo si ya está, si no se envía null
        "customer_id" => 1,
        "default_branch_office_id" => 1,
        // Si no está se envía:
        'customer' => null,
        'sucursal_id' => 1,
        "pos_sale_type" => 1, //Ej: Boleta
        "global_discount" => 10, // En %
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

    public $tempQuotationJSON;

    /**
     * Reset tempQuotationJSON after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempQuotationJSON = $this->QuotationJSON;
    }

    /**
     * Function to call a HTTP POST Request to generate a new sale
     *
     * @return void
     */
    private function newSaleQuotation() {
        return $this->json('POST', 'api/sl_sale_quotation', $this->tempQuotationJSON);
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
        $response = $this->newSaleQuotation();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'quotation_id',
                     'quotation_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert Sale
        $this->assertDatabaseHas('sl_sale_quotation',[
            'id' => $obj->quotation_id,
            'number' => str_pad("$obj->quotation_id", 12, '0', STR_PAD_LEFT),
            'emission_date' => date('Y-m-d'),
            'ticket_total' => 252,
            'invoice_total' => 252,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 10,
            'new_net_subtotal' => 212,
            'iva' => 40,
            'exent_total' => 0,
            'pos_sale_type_id' => $this->tempQuotationJSON['pos_sale_type'],
            'sl_customer_id' => $this->tempQuotationJSON['customer_id'],
            'g_branch_office_id' => $this->tempQuotationJSON['sucursal_id'],
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('sl_detail_sale_quotation', [
            'sl_sale_quotation_id' => $obj->quotation_id,
            'wh_product_id' => $this->QuotationJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->QuotationJSON['sale_detail'][0]['quantity'],
            'price' => $this->QuotationJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('sl_detail_sale_quotation', [
            'sl_sale_quotation_id' => $obj->quotation_id,
            'wh_product_id' => $this->QuotationJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->QuotationJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

    }

    /**
     * Should add customer if customer_id is not sended
     *
     * @return void
     */
    public function test_saveSale_WithCustomerData()
    {
        $this->tempQuotationJSON['customer_id'] = null;
        $this->tempQuotationJSON['default_branch_office_id'] = null;
        $this->tempQuotationJSON['default_branch_office_index'] = 1;
        $this->tempQuotationJSON['customer'] = [
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
        $response = $this->newSaleQuotation();
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'quotation_id',
                     'quotation_id_formatted'
                 ]);
        $obj = json_decode($response->content());

        // Assert New Customer
        $this->assertDatabaseHas('sl_customer', [
            'rut' => $this->tempQuotationJSON['customer']['rut'],
            'business_name' => $this->tempQuotationJSON['customer']['business_name'],
            'alias_name' => $this->tempQuotationJSON['customer']['alias_name'],
            'core_business' => $this->tempQuotationJSON['customer']['core_business'],
            'flag_delete' => false
        ]);

        // Assert Sale
        $this->assertDatabaseHas('sl_sale_quotation',[
            'id' => $obj->quotation_id,
            'number' => str_pad("$obj->quotation_id", 12, '0', STR_PAD_LEFT),
            'emission_date' => date('Y-m-d'),
            'ticket_total' => 252,
            'invoice_total' => 252,
            'net_subtotal' => 236,
            'discount_or_charge_percentage' => 10,
            'new_net_subtotal' => 212,
            'iva' => 40,
            'exent_total' => 0,
            'pos_sale_type_id' => $this->tempQuotationJSON['pos_sale_type'],
            'g_branch_office_id' => $this->tempQuotationJSON['sucursal_id'],
            'flag_delete' => false
        ]);

        // Assert Detalle
        $this->assertDatabaseHas('sl_detail_sale_quotation', [
            'sl_sale_quotation_id' => $obj->quotation_id,
            'wh_product_id' => $this->QuotationJSON['sale_detail'][0]['product_id'],
            'quantity' => $this->QuotationJSON['sale_detail'][0]['quantity'],
            'price' => $this->QuotationJSON['sale_detail'][0]['price'],
            'net_price' => 84.03,
            'net_subtotal' =>84,
            'discount_or_charge_percentage' => 10,
            'discount_or_charge_value' => 0,
            'new_net_subtotal' => 76,
            'total' => 90
        ]);
        $this->assertDatabaseHas('sl_detail_sale_quotation', [
            'sl_sale_quotation_id' => $obj->quotation_id,
            'wh_product_id' => $this->QuotationJSON['sale_detail'][1]['product_id'],
            'quantity' => $this->QuotationJSON['sale_detail'][1]['quantity'],
            'price' => 200,
            'net_price' => 168.07,
            'net_subtotal' =>168,
            'discount_or_charge_percentage' => 0,
            'discount_or_charge_value' => 10,
            'new_net_subtotal' => 160,
            'total' => 190
        ]);

    }

    /**
     * Should throw an exception if global sale data has a bad data
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleDataIsBad() {
        $this->tempQuotationJSON['total'] = 5000;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw an exception if sale has no products
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleHasNoProducts() {
        $this->tempQuotationJSON['sale_detail'] = [];
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw an exception, if customer doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfCustomer_DoesntExists() {
        $this->tempQuotationJSON['customer_id'] = -1;
        $this->tempQuotationJSON['customer'] = null;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw an exception, if customer is not sended
     *
     * @return void
     */
    public function test_shouldThrowException_IfCustomer_IsNotSended() {
        $this->tempQuotationJSON['customer_id'] = null;
        $this->tempQuotationJSON['customer'] = null;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if branch office doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfBranchOffice_DoesntExists() {
        $this->tempQuotationJSON['sucursal_id'] = -1;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw exception, if sale type (ticket, invoice) doesnt exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfSaleType_DoesntExists() {
        $this->tempQuotationJSON['pos_sale_type'] = -1;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product doesn't exists in database
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductDoesntExists() {
        $this->tempQuotationJSON['sale_detail'][1]['product_id'] = -1;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product has no price
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductHasNoPrice() {
        $this->tempQuotationJSON['sale_detail'][1]['product_id'] = 3;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

    /**
     * Should throw exception if product is not salable
     *
     * @return void
     */
    public function test_shouldThrowException_IfProductIsNotSalable() {
        $this->tempQuotationJSON['sale_detail'][0]['product_id'] = 3;
        $response = $this->newSaleQuotation();
        $this->assertError($response);
    }

}
