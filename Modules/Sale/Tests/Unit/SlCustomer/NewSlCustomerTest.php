<?php

namespace Modules\Sale\Tests\Unit\SlCustomer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewSlCustomerTest extends TestCase
{
    // JSON EXAMPLE.
    public $customerJSON = [
        'rut' => '18158869-1', // Ejemplo 12345678-0
        'business_name' => 'InnLAB S.A',  // Razón social
        'alias_name' => 'InnLAB', // Nombre / Nombre de Fantasía
        'core_business' => 'Tecnologías de la Información',
        'branch_offices' => [
            [
                'address' => 'Ramon Solar #423',
                'phone' => '+56 9 8888 8888', // Opcional
                'email' => 'contacto@dgz.cl',
                'g_commune_id' => 27, // Coquimbo
                'default_branch_office' => true
            ],
        ],
    ];

    public $tempCustomerJSON;

    /**
     * Reset tempCustomerJSON after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempCustomerJSON = $this->customerJSON;
    }

    /**
     * Function to call a HTTP POST Request to generate a new customer
     *
     * @return void
     */
    private function newCustomer() {
        return $this->json('POST', 'api/sl_customer', $this->tempCustomerJSON);
    }

    /**
     * Function to assert a 500 error
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
     * Should store customer in database
     *
     * @return void
     */
    public function test_saveCustomer()
    {
        $response = $this->newCustomer();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'customer_id',
                     'customer_account_id'
                 ]);
        $obj = json_decode($response->content());

        $this->assertDatabaseHas('sl_customer',[
            'id' => $obj->customer_id,
            'sl_customer_account_id' => $obj->customer_account_id,
            'rut' => $this->tempCustomerJSON['rut'],
            'business_name' => $this->tempCustomerJSON['business_name'],
            'alias_name' => $this->tempCustomerJSON['alias_name'],
            'core_business' => $this->tempCustomerJSON['core_business'],
            'flag_delete' => false
        ]);

        $this->assertDatabaseHas('sl_customer_account',[
            'id' => $obj->customer_id,
            'sl_customer_id' => $obj->customer_id,
            'debt_amount' => 0,
            'flag_delete' => false
        ]);

        // Assert customer branch offices
        foreach($this->tempCustomerJSON['branch_offices'] as $branchOffice)
        {
            $this->assertDatabaseHas('sl_customer_branch_offices', [
                'sl_customer_id' => $obj->customer_id,
                'address' => $branchOffice['address'],
                'phone' => $branchOffice['phone'],
                'email' => $branchOffice['email'],
                'g_commune_id' => $branchOffice['g_commune_id'],
                'default_branch_office' => $branchOffice['default_branch_office'],
            ]);
        }
    }

    /**
     * Should throw an exception if rut is already taken
     *
     * @return void
     */
    public function test_shouldThrowException_IfRutIsAlreadyTaken() {
        $response = $this->newCustomer();
        $this->assertError($response, 500);
    }

    /**
     * Should throw an exception if data is invalid
     *
     * @return void
     */
    public function test_shouldThrowException_DataIsInvalid() {
        $this->tempCustomerJSON = [
            'rut' => 'AAAAAAAAAAAAAAAAAAAAAA',
            'business_name' => '',
            'alias_name' => '',
            'core_business' => '',
            'branch_offices' => [
                [
                    'address' => '',
                    'phone' => '+56 9 8888 8888', // Opcional
                    'email' => 'NO SOY UN EMAIL',
                    'g_commune_id' => 99999, // Coquimbo
                ],
            ],
        ];
        $response = $this->newCustomer();
        $response->assertStatus(422)
             ->assertJson([
                'status' => 'error',
                'http_status_code' => 422
             ])
             ->assertJsonStructure([
                'status',
                'http_status_code',
                'errors' => [
                    'rut',
                    'business_name',
                    'alias_name',
                    'core_business',
                ]
             ]);
    }
}
