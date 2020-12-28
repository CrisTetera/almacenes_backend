<?php

namespace Modules\Warehouse\Tests\Unit\WhFamily;

use Tests\TestCase;
use Modules\General\Entities\GUserPos;

class CrudWhFamilyTest extends TestCase
{
    public $json = [
        'family' => 'Insertando Familia'
    ];

    public $tempJson;

    /**
     * Constant ID User to login
     */
    private const ID_USER = 1;    

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() : void {
        parent::setUp();
        $this->tempJson = $this->json;

        $user = GUserPos::find(self::ID_USER);
        $this->actingAs($user, 'api');
    }

    /**
     * Function to call a HTTP POST
     *
     * @return void
     */
    private function storeFamily() {
        return $this->json('POST', 'api/wh_family_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateFamily($id) {
        return $this->json('PUT', "api/wh_family_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteFamily($id) {
        return $this->json('DELETE', "api/wh_family_pos/$id");
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
     * Test should store family
     *
     * @return void
     */
    public function test_ShouldStoreFamily()
    {
        $response = $this->storeFamily();
        dump($response);
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'family_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Family
        $this->assertDatabaseHas('wh_family_pos', [
            'id' => $obj->family_id,
            'family' => $this->tempJson['family'],
            'flag_delete' => false
        ]);

        return $obj->family_id;
    }

    /**
     * Test should throw exception if family doesnt exists in database when updating
     *
     * @depends test_ShouldStoreFamily
     * @return void
     */
    public function test_ShouldThrowException_IfFamilyDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateFamily(-1);
        $this->assertError($response);
    }

    /**
     * Test should update family
     *
     * @depends test_ShouldStoreFamily
     * @return void
     */
    public function test_ShouldUpdateFamily($id)
    {
        $this->tempJson['family'] = 'Actualizando Familia';
        $response = $this->updateFamily($id);
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
        $this->assertDatabaseHas('wh_family_pos', [
            'id' => $id,
            'family' => $this->tempJson['family'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if product doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreFamily
     * @return void
     */
    public function test_ShouldThrowException_IfFamilyDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteFamily(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically family
     *
     * @depends test_ShouldStoreFamily
     * @return void
     */
    public function test_ShouldDeleteFamily($id)
    {
        $response = $this->deleteFamily($id);
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
        $this->assertDatabaseHas('wh_family_pos', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }
}
