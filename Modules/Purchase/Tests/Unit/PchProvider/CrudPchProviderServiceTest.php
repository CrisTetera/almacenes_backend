<?php

namespace Modules\Purchase\Tests\Unit\PchProvider;

use Tests\TestCase;
use Modules\Purchase\Entities\PchProviderBranchOffices;

class CrudPchProviderServiceTest extends TestCase
{
    public $json = [
        'rut' => '23846081-6',
        'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',  // Razón social
        'alias_name' => 'ENTEL PCS S.A.', // Nombre / Nombre de Fantasía
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
    private function storeProvider() {
        return $this->json('POST', 'api/pch_provider', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateProvider($id) {
        return $this->json('PUT', "api/pch_provider/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteProvider($id) {
        return $this->json('DELETE', "api/pch_provider/$id");
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
     * Test should store provider
     *
     * @return void
     */
    public function test_ShouldStoreProvider()
    {
        $response = $this->storeProvider();
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'provider_id',
                     'provider_account_id'
                 ]);
        $obj = json_decode( $response->content() );

        // Assert pch provider
        $this->assertDatabaseHas('pch_provider', [
            'id' => $obj->provider_id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'flag_delete' => false
        ]);
        // Assert pch Provider Account
        $this->assertDatabaseHas('pch_provider_account', [
            'id' => $obj->provider_account_id,
            'pch_provider_id' => $obj->provider_id,
            'flag_delete' => false
        ]);
        // Assert provider branch offices
        foreach($this->tempJson['branch_offices'] as $branchOffice)
        {
            $this->assertDatabaseHas('pch_provider_branch_offices', [
                'pch_provider_id' => $obj->provider_id,
                'address' => $branchOffice['address'],
                'phone' => $branchOffice['phone'],
                'email' => $branchOffice['email'],
                'g_commune_id' => $branchOffice['g_commune_id'],
                'default_branch_office' => $branchOffice['default_branch_office'],
            ]);
        }

        return $obj->provider_id;
    }

    /**
     * Test should throw exception if provider doesnt exists in database when updating
     *
     * @depends test_ShouldStoreProvider
     * @return void
     */
    public function test_ShouldThrowException_IfProviderDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateProvider(-1);
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
        $this->assertError($response);
    }

    /**
     * Test should update provider
     *
     * @depends test_ShouldStoreProvider
     * @return void
     */
    public function test_ShouldUpdateProvider($id)
    {
        $this->tempJson = [
            'rut' => '23846081-6',
            'business_name' => 'ENTEL PCS TELECOMUNICACIONES S.A.',  // Razón social
            'alias_name' => 'ENTEL PCS S.A.', // Nombre / Nombre de Fantasía
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
        ];
        $response = $this->updateProvider($id);
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
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

        // Assert pch Provider
        $this->assertDatabaseHas('pch_provider', [
            'id' => $id,
            'rut' => $this->tempJson['rut'],
            'business_name' => $this->tempJson['business_name'],
            'alias_name' => $this->tempJson['alias_name'],
            'flag_delete' => false
        ]);
        // Assert provider branch offices
        foreach($this->tempJson['branch_offices'] as $branchOffice)
        {
            $this->assertDatabaseHas('pch_provider_branch_offices', [
                'pch_provider_id' => $obj->provider_id,
                'address' => $branchOffice['address'],
                'phone' => $branchOffice['phone'],
                'email' => $branchOffice['email'],
                'g_commune_id' => $branchOffice['g_commune_id'],
                'default_branch_office' => $branchOffice['default_branch_office'],
            ]);
        }
    }

    /**
     * Test should throw exception if provider doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreProvider
     * @return void
     */
    public function test_ShouldThrowException_IfProviderDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteProvider(-1);
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
        $this->assertError($response);
    }

    /**
     * Test should delete logically provider
     *
     * @depends test_ShouldStoreProvider
     * @return void
     */
    public function test_ShouldDeleteProvider($id)
    {
        $response = $this->deleteProvider($id);
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
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

        // Assert pch Provider
        $this->assertDatabaseHas('pch_provider', [
            'id' => $id,
            'flag_delete' => true
        ]);
        // Assert pch Provider Branch Offices
        $branchOffices = PchProviderBranchOffices::where('pch_provider_id', $id)->get();
        $branchOffices->each(function($item) {
            $this->assertDatabaseHas('pch_provider_branch_offices', [
                'id' => $item->id,
                'flag_delete' => true
            ]);
        });
    }
}
