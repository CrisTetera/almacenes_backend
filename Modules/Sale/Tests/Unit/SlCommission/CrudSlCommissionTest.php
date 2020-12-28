<?php

namespace Modules\Sale\Tests\Unit\SlCommission;

use Tests\TestCase;


class CrudSlCommissionTest extends TestCase
{
    public $json = [
        'sl_commission_type_id' => 1,
        'name' => 'Comisión Test',
        'description' => '',
        'percentage' => 12.5,
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
    private function storeCommission() {
        return $this->json('POST', 'api/sl_commission', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateCommission($id) {
        return $this->json('PUT', "api/sl_commission/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteCommission($id) {
        return $this->json('DELETE', "api/sl_commission/$id");
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
     * Test should throw exception if not param is sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNotParamsAreSended()
    {
        $this->tempJson = [];
        $response = $this->storeCommission();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response, 422);
    }

    /**
     * Test should store Commission
     *
     * @return void
     */
    public function test_ShouldStoreCommission()
    {
        $response = $this->storeCommission();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'commission_id'
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Sl Commission
        $this->assertDatabaseHas('sl_commission', [
            'id' => $obj->commission_id,
            'sl_commission_type_id' => $this->tempJson['sl_commission_type_id'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'percentage' => $this->tempJson['percentage'],
            'flag_delete' => false
        ]);

        return $obj->commission_id;
    }

    /**
     * Test should throw exception if Commission doesnt exists in database when updating
     *
     * @depends test_ShouldStoreCommission
     * @return void
     */
    public function test_ShouldThrowException_IfCommissionDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateCommission(-1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should update Commission
     *
     * @depends test_ShouldStoreCommission
     * @return void
     */
    public function test_ShouldUpdateCommission($id)
    {
        $this->tempJson = [
            'sl_commission_type_id' => 2,
            'name' => 'Comisión Actualizada',
            'description' => 'Descripción Comisión Actualizada',
            'percentage' => 20
        ];
        $response = $this->updateCommission($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
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

        // Assert Sl Commission
        $this->assertDatabaseHas('sl_commission', [
            'id' => $id,
            'sl_commission_type_id' => $this->tempJson['sl_commission_type_id'],
            'name' => $this->tempJson['name'],
            'description' => $this->tempJson['description'],
            'percentage' => $this->tempJson['percentage'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if product doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreCommission
     * @return void
     */
    public function test_ShouldThrowException_IfCommissionDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteCommission(-1);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $this->assertError($response);
    }

    /**
     * Test should delete logically Commission
     *
     * @depends test_ShouldStoreCommission
     * @return void
     */
    public function test_ShouldDeleteCommission($id)
    {
        $response = $this->deleteCommission($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
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

        // Assert Sl Commission
        $this->assertDatabaseHas('sl_commission', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }
}
