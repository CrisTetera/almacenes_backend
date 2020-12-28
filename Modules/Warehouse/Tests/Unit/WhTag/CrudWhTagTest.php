<?php

namespace Modules\Warehouse\Tests\Unit\WhTag;

use Tests\TestCase;
use Modules\General\Entities\GUserPos;

class CrudWhTagTest extends TestCase
{

    public $json = [
        'tag' => 'Soy un tag',
        'description' => 'Soy la descripción del tag'
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
    private function storeTag() {
        return $this->json('POST', 'api/wh_tag_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateTag($id) {
        return $this->json('PUT', "api/wh_tag_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteTag($id) {
        return $this->json('DELETE', "api/wh_tag_pos/$id");
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
     * Test should store tag
     *
     * @return void
     */
    public function test_ShouldStoreTag()
    {
        $response = $this->storeTag();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'tag_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Tag
        $this->assertDatabaseHas('wh_tag_pos', [
            'id' => $obj->tag_id,
            'tag' => $this->tempJson['tag'],
            'description' => $this->tempJson['description'],
            'flag_delete' => false
        ]);

        return $obj->tag_id;
    }

    /**
     * Test should throw exception if tag doesnt exists in database when updating
     *
     * @depends test_ShouldStoreTag
     * @return void
     */
    public function test_ShouldThrowException_IfTagDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateTag(-1);
        $this->assertError($response);
    }

    /**
     * Test should update tag
     *
     * @depends test_ShouldStoreTag
     * @return void
     */
    public function test_ShouldUpdateTag($id)
    {
        $this->tempJson['tag'] = 'Actualizando Tag';
        $this->tempJson['description'] = '';
        $response = $this->updateTag($id);
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

        // Assert Wh Tag
        $this->assertDatabaseHas('wh_tag_pos', [
            'id' => $id,
            'tag' => $this->tempJson['tag'],
            'description' => $this->tempJson['description'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if product doesn´t exists in database when deleting
     *
     * @depends test_ShouldStoreTag
     * @return void
     */
    public function test_ShouldThrowException_IfTagDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteTag(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically tag
     *
     * @depends test_ShouldStoreTag
     * @return void
     */
    public function test_ShouldDeleteTag($id)
    {
        $response = $this->deleteTag($id);
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

        // Assert Wh Tag
        $this->assertDatabaseHas('wh_tag_pos', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }

}
