<?php

namespace Modules\Sale\Tests\Unit\SlCustomer;

use Tests\TestCase;
use Modules\Sale\Entities\SlCustomerBranchOffices;

class CrudSlCustomerTest extends TestCase
{

    public $json = [
        'rut' => '96806980-2',
        'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',  // Razón social
        'alias_name' => 'ENTEL PCS S.A.', // Nombre / Nombre de Fantasía
        'core_business' => 'GIRO DE ENTEL', // Giro
        'branch_offices' => [
            [
                'address' => 'AVD COSTANERA',
                'phone' => '+56 9 1234 5678', // Opcional
                'email' => 'email.de.entel@gmail.com',
                'g_commune_id' => 26, // La Serena
                'default_branch_office' => true
            ],
            [
                'address' => 'AVD COSTANERA 2',
                'phone' => '', // Opcional
                'email' => 'email.de.entel2@gmail.com',
                'g_commune_id' => 27,
                'default_branch_office' => false
            ]
        ],
        // Extra:
        'discount' => 10
    ];

    public $tempJson;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempJson = $this->json;
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function storeCustomer() {
        return $this->json('POST', 'api/sl_customer', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateCustomer($id) {
        return $this->json('PUT', "api/sl_customer/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteCustomer($id) {
        return $this->json('DELETE', "api/sl_customer/$id");
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
     * Test should store customer
     *
     * @return void
     */
    public function test_ShouldStoreCustomer()
    {
        $response = $this->storeCustomer();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'customer_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Sl Customer
        $this->assertDatabaseHas('sl_customer', [
            'id' => $obj->customer_id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'core_business' => $this->tempJson['core_business'],
            'flag_delete' => false
        ]);
        // Assert Sl Customer Account
        $this->assertDatabaseHas('sl_customer_account', [
            'id' => $obj->customer_account_id,
            'sl_customer_id' => $obj->customer_id
        ]);
        // Assert sl_customer_presets_discount
        $this->assertDatabaseHas('sl_customer_presets_discount', [
            'sl_customer_id' => $obj->customer_id,
            'discount_percentage' => $this->tempJson['discount'],
            'flag_delete' => false
        ]);
        // Assert customer branch offices
        foreach($this->tempJson['branch_offices'] as $branchOffice)
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

        return $obj->customer_id;
    }

    /**
     * Test should store customer
     *
     * @return void
     */
    public function test_ShouldStoreCustomer_WithNoEmail()
    {
        $this->tempJson['rut'] = '23804062-0';
        $this->tempJson['email'] = '';
        $response = $this->storeCustomer();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'customer_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Sl Customer
        $this->assertDatabaseHas('sl_customer', [
            'id' => $obj->customer_id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'core_business' => $this->tempJson['core_business'],
            'flag_delete' => false
        ]);
        // Assert Sl Customer Account
        $this->assertDatabaseHas('sl_customer_account', [
            'id' => $obj->customer_account_id,
            'sl_customer_id' => $obj->customer_id
        ]);
        // Assert sl_customer_presets_discount
        $this->assertDatabaseHas('sl_customer_presets_discount', [
            'sl_customer_id' => $obj->customer_id,
            'discount_percentage' => $this->tempJson['discount'],
            'flag_delete' => false
        ]);
        // Assert customer branch offices
        foreach($this->tempJson['branch_offices'] as $branchOffice)
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
            'core_business' => 'GIRO DE ENTEL', // Giro
            'branch_offices' => [
                [
                    'address' => 'AVD COSTANERA',
                    'phone' => '+56 9 1234 5678', // Opcional
                    'email' => 'email.de.entel@gmail.com',
                    'g_commune_id' => 26, // La Serena
                    'default_branch_office' => false
                ],
                [
                    'address' => 'AVD COSTANERA NEW',
                    'phone' => '', // Opcional
                    'email' => 'email.de.entel.new@gmail.com',
                    'g_commune_id' => 27,
                    'default_branch_office' => true
                ]
            ],
            // Discount
            'discount' => 0
        ];
        $response = $this->updateCustomer($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Sl Customer
        $this->assertDatabaseHas('sl_customer', [
            'id' => $id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'core_business' => $this->tempJson['core_business'],
            'flag_delete' => false
        ]);
        // Assert sl_customer_presets_discount
        $this->assertDatabaseHas('sl_customer_presets_discount', [
            'sl_customer_id' => $obj->customer_id,
            'discount_percentage' => $this->tempJson['discount'],
            'flag_delete' => false
        ]);
        // Assert customer branch offices
        foreach($this->tempJson['branch_offices'] as $branchOffice)
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
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Sl Customer
        $this->assertDatabaseHas('sl_customer', [
            'id' => $id,
            'flag_delete' => true
        ]);
        // Assert Sl Customer Branch Offices
        $branchOffices = SlCustomerBranchOffices::where('sl_customer_id', $id)->get();
        $branchOffices->each(function($item) {
            $this->assertDatabaseHas('sl_customer_branch_offices', [
                'id' => $item->id,
                'flag_delete' => true
            ]);
        });
    }

}
