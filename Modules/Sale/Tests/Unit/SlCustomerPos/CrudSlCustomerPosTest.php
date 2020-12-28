<?php

namespace Modules\Sale\Tests\Unit\SlCustomerPos;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\CustomTestCase;
use Modules\Sale\Entities\SlCustomerPos;

class CrudSlCustomerPosTest extends CustomTestCase
{

    public $json = [
        'rut' => '96806980-2',
        'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',  // Razón social
        'alias_name' => 'ENTEL PCS S.A.', // Nombre / Nombre de Fantasía
        'commercial_business' => 'GIRO DE ENTEL', // Giro
        'address' => 'AVD COSTANERA',
        'phone_number' => '+56 9 1234 5678', // Opcional
        'email' => 'email.de.entel@gmail.com',
        'g_commune_id' => 26 // La Serena
    ];



    public $json2 = [
        'rut' => '96806980-2',
        'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',  // Razón social
        'alias_name' => 'ENTEL PCS S.A.', // Nombre / Nombre de Fantasía
        'commercial_business' => 'GIRO DE ENTEL', // Giro
        'address' => 'AVD COSTANERA 2',
        'phone_number' => '', // Opcional
        'email' => 'email.de.entel2@gmail.com',
        'g_commune_id' => 27
    ];

    public $tempJson;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() : void {
        parent::setUp();
        $this->tempJson = $this->json;
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function storeCustomer() {
        return $this->json('POST', 'api/sl_customer_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateCustomer($id) {
        return $this->json('PUT', "api/sl_customer_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteCustomer($id) {
        return $this->json('DELETE', "api/sl_customer_pos/$id");
    }

    /**
     * Test should store customer
     *
     * @return void
     */
    public function test_ShouldStoreCustomer()
    {   
        $response = $this->storeCustomer();
        $this->dumpError($response);
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ]);/*
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'customer_id',
                 ]);*/
        $obj = json_decode( $response->content());

        // Assert customer branch offices

        $this->assertDatabaseHas('sl_customer_pos', [
            'id' => $obj->customer_id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'commercial_business' => $this->tempJson['commercial_business'],
            'address' => $this->tempJson['address'],
            'phone_number' => $this->tempJson['phone_number'],
            'email' => $this->tempJson['email'],
            'g_commune_id' => $this->tempJson['g_commune_id'],
            'flag_delete' => false,
        ]);

        return $obj->customer_id;
    }

    /**
     * Test should store customer
     *
     * @return void
     */
    public function test_ShouldStoreCustomer_WithNoEmail()
    {
        SlCustomerPos::where('rut','23804062-0')->update(
            [
                'flag_delete'=> true
            ]
        );
        $this->tempJson['rut'] = '23804062-0';
        $this->tempJson['email'] = '';
        $response = $this->storeCustomer();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ]);/*
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'customer_id',
                 ]);*/
        $obj = json_decode( $response->content() );

        $this->assertDatabaseHas('sl_customer_pos', [
            'id' => $obj->customer_id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'commercial_business' => $this->tempJson['commercial_business'],
            'address' => $this->tempJson['address'],
            'phone_number' => $this->tempJson['phone_number'],
            'email' => $this->tempJson['email'],
            'g_commune_id' => $this->tempJson['g_commune_id'],
            'flag_delete' => false,
        ]);
        return $obj->customer_id;
    }

    /**
     * Test should throw exception if customer doesnt exists in database when updating
     *
     * @depends test_ShouldStoreCustomer
     * @return void
     */
    public function test_ShouldThrowException_IfCustomerDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateCustomer(-1);
        $this->assertError($response);
    }

    /**
     * Test should update customer
     *
     * @depends test_ShouldStoreCustomer
     * @return void
     */
    public function test_ShouldUpdateCustomer($id)
    {
        $this->tempJson = [
            'rut' => '96806980-2',
            'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',  // Razón social
            'alias_name' => 'ENTEL PCS S.A.', // Nombre / Nombre de Fantasía
            'commercial_business' => 'GIRO DE ENTEL', // Giro
            'address' => 'AVD COSTANERA',
            'phone_number' => '+56 9 1234 5678', // Opcional
            'email' => 'email.de.entel@gmail.com',
            'g_commune_id' => 26 // La Serena
        ];
        $response = $this->updateCustomer($id);
        $this->dump($response);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ]);/*
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);*/
        $obj = json_decode( $response->content() );
        
        $this->assertDatabaseHas('sl_customer_pos', [
            'id' => $id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'commercial_business' => $this->tempJson['commercial_business'],
            'address' => $this->tempJson['address'],
            'phone_number' => $this->tempJson['phone_number'],
            'email' => $this->tempJson['email'],
            'g_commune_id' => $this->tempJson['g_commune_id'],
            'flag_delete' => false,
        ]);
    }

    /**
     * Test should throw exception if customer doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreCustomer
     * @return void
     */
    public function test_ShouldThrowException_IfCustomerDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteCustomer(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically customer
     *
     * @depends test_ShouldStoreCustomer
     * @return void
     */
    public function test_ShouldDeleteCustomer($id)
    {
        $response = $this->deleteCustomer($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ]);/*
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);*/
        $obj = json_decode( $response->content() );

        // Assert Sl Customer
        $this->assertDatabaseHas('sl_customer_pos', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }

}
