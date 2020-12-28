<?php

namespace Modules\Sale\Tests\Unit\SlOffer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CrudSlOfferTest extends TestCase
{

    use WithoutMiddleware;
    
    public $json = [
        'wh_product_id' => 1,
        'name' => 'name from crud test',
        'offer_price' => 300,
        // 'init_datetime' => date('Y-m-d'),
        // 'finish_datetime' => date('Y-m-d', strtotime('+7 days'))
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
    private function storeOffer() {
        return $this->json('POST', 'api/sl_offer_pos', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateOffer($id) {
        return $this->json('PUT', "api/sl_offer_pos/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteOffer($id) {
        return $this->json('DELETE', "api/sl_offer_pos/$id");
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
     * Function to assert and 422 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertErrorValidation($response)
    {
        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    } // end foreach

    /**
     * Test should throw exception if init date is before today
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIfInitDateIsBeforeToday()
    {
        $this->tempJson['init_datetime'] = date('Y-m-d', strtotime('-3 days'));
        $this->tempJson['finish_datetime'] = date('Y-m-d', strtotime('+3 days'));
        $response = $this->storeOffer();
        // dump($response);
        $this->assertError($response);
    }

    /**
     * Test should throw exception if finish date is before init date
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIfFinishDateIsBeforeInitDate()
    {
        $this->tempJson['init_datetime'] = date('Y-m-d', strtotime('+5 days'));
        $this->tempJson['finish_datetime'] = date('Y-m-d', strtotime('+1 days'));
        $response = $this->storeOffer();
        $this->assertError($response);
    }

    /**
     * Test should throw exception if name is not set in store sl_offer
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIfNameIsNotSetInStore()
    {
        unset($this->tempJson['name']);
        $response = $this->storeOffer();
        $this->assertErrorValidation($response);
    }

    /**
     * Test should throw exception if name has invalida datatyp in store sl_offer
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIfName_withInvalidDataType_InStore()
    {
        $this->tempJson['name'] = [1, 2, 3]; // must to be string
        $response = $this->storeOffer();
        $this->assertErrorValidation($response);
    }

    /**
     * Test should throw exception if name is not set in update sl_offer
     * @return void
     */
    public function test_ShouldThrowExceptionIfNameIsNotSetInUpdate()
    {
        $idOffer = 1; //edit first offer in DB
        unset($this->tempJson['name']);
        $response = $this->updateOffer($idOffer);
        $this->assertErrorValidation($response);
    }

    /**
     * Test should throw exception if name has invalid datatype in update sl_offer
     * @return void
     */
    public function test_ShouldThrowExceptionIfName_withInvalidDataType_InUpdate()
    {
        $idOffer = 1; //edit first offer in DB
        $this->tempJson['name'] = [1, 2, 3]; // must to be string
        $response = $this->updateOffer($idOffer);
        $this->assertErrorValidation($response);
    }

    /**
     * Test should store offer
     *
     * @return void
     */
    public function test_ShouldStoreOffer()
    {
        $this->tempJson['init_datetime'] = date('Y-m-d');
        $this->tempJson['finish_datetime'] = date('Y-m-d', strtotime('+7 days'));
        $response = $this->storeOffer();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'offer_id',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Sl Offer
        $this->assertDatabaseHas('sl_offer_pos', [
            'id' => $obj->offer_id,
            'wh_product_id' => $this->tempJson['wh_product_id'],
            'name' => $this->tempJson['name'],
            'offer_price' => $this->tempJson['offer_price'],
            'init_datetime' => $this->tempJson['init_datetime'],
            'finish_datetime' => $this->tempJson['finish_datetime'],
            'flag_delete' => false
        ]);

        return $obj->offer_id;
    }

    /**
     * Test should throw exception if offer doesnt exists in database when updating
     *
     * @depends test_ShouldStoreOffer
     * @return void
     */
    public function test_ShouldThrowException_IfOfferDoesntExists_WhenUpdate($id)
    {
        $this->tempJson['init_datetime'] = date('Y-m-d', strtotime('+1 days'));
        $this->tempJson['finish_datetime'] = date('Y-m-d', strtotime('+9 days'));
        $response = $this->updateOffer(-1);
        $this->assertError($response);
    }

    /**
     * Test should update offer
     *
     * @depends test_ShouldStoreOffer
     * @return void
     */
    public function test_ShouldUpdateOffer($id)
    {
        $this->tempJson = [
            'wh_product_id' => 2,
            'name' => 'name from crud test',
            'offer_price' => 400,
            'init_datetime' => date('Y-m-d', strtotime('+1 days')),
            'finish_datetime' => date('Y-m-d', strtotime('+9 days'))
        ];
        $response = $this->updateOffer($id);
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

        // Assert Sl Offer
        $this->assertDatabaseHas('sl_offer_pos', [
            'id' => $id,
            'wh_product_id' => $this->tempJson['wh_product_id'],
            'name' => $this->tempJson['name'],
            'offer_price' => $this->tempJson['offer_price'],
            'init_datetime' => $this->tempJson['init_datetime'],
            'finish_datetime' => $this->tempJson['finish_datetime'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if offer doesnt exists
     *
     * @depends test_ShouldStoreOffer
     * @return void
     */
    public function test_ShouldThrowException_IfOfferDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteOffer(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically family
     *
     * @depends test_ShouldStoreOffer
     * @return void
     */
    public function test_ShouldDeleteOffer($id)
    {
        $response = $this->deleteOffer($id);
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

        // Assert Sl Offer
        $this->assertDatabaseHas('sl_offer_pos', [
            'id' => $id,
            'flag_delete' => true
        ]);
    }

}
