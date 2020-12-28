<?php

namespace Modules\Warehouse\Tests\Unit\WhSubfamily;

use Tests\TestCase;


class CrudWhSubfamilyTest extends TestCase
{

    public $json = [
        'wh_family_id' => 1,
        'subfamily' => 'Insertando Subfamilia'
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
    private function storeSubfamily() {
        return $this->json('POST', 'api/wh_subfamily', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateSubfamily($id) {
        return $this->json('PUT', "api/wh_subfamily/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteSubfamily($id) {
        return $this->json('DELETE', "api/wh_subfamily/$id");
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
     * Test should store subfamily
     *
     * @return void
     */
    public function test_ShouldThrowException_IfSubfamilyDoesntExists()
    {
        $this->tempJson['wh_family_id'] = 999999;
        $response = $this->storeSubfamily();
        $response->assertStatus(422);
    }

    /**
     * Test should store subfamily
     *
     * @return void
     */
    public function test_ShouldStoreSubFamily()
    {
        $response = $this->storeSubfamily();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'subfamily_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh SubFamily
        $this->assertDatabaseHas('wh_subfamily', [
            'id' => $obj->subfamily_id,
            'subfamily' => $this->tempJson['subfamily'],
            'wh_family_id' => $this->tempJson['wh_family_id'],
            'flag_delete' => false
        ]);

        return $obj->subfamily_id;
    }

    /**
     * Test should throw exception if subfamily doesnt exists in database when updating
     *
     * @depends test_ShouldStoreSubFamily
     * @return void
     */
    public function test_ShouldThrowException_IfFamilyDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateSubfamily(-1);
        $this->assertError($response);
    }

    /**
     * Test should update subfamily
     *
     * @depends test_ShouldStoreSubFamily
     * @return void
     */
    public function test_ShouldUpdateSubFamily($id)
    {
        $this->tempJson['subfamily'] = 'Actualizando SubFamilia';
        $response = $this->updateSubfamily($id);
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

        // Assert Wh Family
        $this->assertDatabaseHas('wh_subfamily', [
            'id' => $id,
            'subfamily' => $this->tempJson['subfamily'],
            'wh_family_id' => $this->tempJson['wh_family_id'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if product doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreSubFamily
     * @return void
     */
    public function test_ShouldThrowException_IfFamilyDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteSubfamily(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically subfamily
     *
     * @depends test_ShouldStoreSubFamily
     * @return void
     */
    public function test_ShouldDeleteFamily($id)
    {
        $response = $this->deleteSubfamily($id);
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

        // Assert Wh Family
        $this->assertDatabaseHas('wh_subfamily', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }

}
