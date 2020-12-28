<?php

namespace Modules\Sale\Tests\Unit\SlCustomerPos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\CustomTestCase;
use Modules\Sale\Entities\SlCustomerPos;

class NewSlCustomerPosTest extends CustomTestCase
{
    // JSON EXAMPLE.
    public $customerJSON = [
        
        'rut' => '18158869-1', // Ejemplo 12345678-0
        'business_name' => 'InnLAB S.A',  // Razón social
        'alias_name' => 'InnLAB', // Nombre / Nombre de Fantasía
        'commercial_business' => 'Tecnologías de la Información',
        'address' => 'Ramon Solar #423',
        'phone_number' => '+56 9 8888 8888', // Opcional
        'email' => 'contacto@dgz.cl',
        'g_commune_id' => 27, // Coquimbo
    ];

    public $tempCustomerJSON;

    /**
     * Reset tempCustomerJSON after each test
     *
     * @return void
     */
    protected function setUp() : void {
        parent::setUp();
        $this->tempCustomerJSON = $this->customerJSON;
    }

    /**
     * Function to call a HTTP POST Request to generate a new customer
     *
     * @return void
     */
    private function newCustomer() {
        return $this->json('POST', 'api/sl_customer_pos', $this->tempCustomerJSON);
    }

    /**
     * Function to assert a 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    protected function assertError($response, $code = 500) {
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
        SlCustomerPos::where('rut','18158869-1')->update([
            'flag_delete'=> true
        ]);
        $response = $this->newCustomer();
        $this->dump($response);
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ]);/*
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'customer_id'
                 ]);*/
                 $this->dump($response);
        $obj = json_decode($response->content());

        // Assert customer branch offices
        $this->assertDatabaseHas('sl_customer_pos', [
            'id' => $obj->customer_id,
            'rut' => $this->tempCustomerJSON['rut'],
            'business_name' => $this->tempCustomerJSON['business_name'],
            'alias_name' => $this->tempCustomerJSON['alias_name'],
            'commercial_business' => $this->tempCustomerJSON['commercial_business'],
            'address' => $this->tempCustomerJSON['address'],
            'phone_number' => $this->tempCustomerJSON['phone_number'],
            'email' => $this->tempCustomerJSON['email'],
            'g_commune_id' => $this->tempCustomerJSON['g_commune_id'],
            'flag_delete' => false
            
        ]);

        return $obj->customer_id;

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
            'commercial_business' => '',
            'address' => '',
            'phone_number' => '+56 9 8888 8888', // Opcional
            'email' => 'NO SOY UN EMAIL',
            'g_commune_id' => 99999, // Coquimbo

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
                    'commercial_business'
                ]
             ]);
    }
}
