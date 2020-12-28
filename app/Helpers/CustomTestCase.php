<?php

namespace App\Helpers;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Modules\General\Entities\GUserPos;

class CustomTestCase extends TestCase
{
    /** @var array $tempJson */
    public $tempJson;

    public const USER_ID = 1;

    /** @var GUserPos $user */
    public $user;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() :void
    {
        parent::setUp();
        $this->user = GUserPos::find(self::USER_ID);
        $this->actingAs($this->user, 'api');
    }

    /**
     * Function to assert and 500 error
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
     * Function to assert and 404 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    protected function assertNotFoundError($response) {
        $response->assertStatus(404)
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
    protected function assertValidationError($response) {
        $response->assertStatus(422)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    protected function dump($response)
    {
        dump(json_decode($response->content(), JSON_PRETTY_PRINT));
    }

    protected function dumpError($response)
    {
        $obj = json_decode($response->content(), JSON_PRETTY_PRINT);
        if (isset($obj['error']))
        {
            dump($obj['error']);
        }else
        {
            dump($obj);
        }
    }

    protected function assertCreated($response, ...$extraJsonStructure)
    {
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure(array_merge([
                    'status',
                    'http_status_code',
                 ], $extraJsonStructure));
    }

    protected function assertOk($response)
    {
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
    }

    protected function assertWarehouseItem(int $warehouse_id, int $item_id, float $stock, bool $flag_delete = false)
    {
        $this->assertDatabaseHas('wh_item_stock_pos', [
            'wh_warehouse_id' => $warehouse_id,
            'wh_item_id' => $item_id,
            'stock' => $stock,
            'flag_delete' => $flag_delete
        ]);
    }

    protected function setStock(int $warehouse_id, int $item_id, int $stock)
    {
        DB::table('wh_item_stock_pos')->where('wh_warehouse_id', $warehouse_id)
                                      ->where('wh_item_id', $item_id)
                                      ->update(['stock' => $stock]);
    }

    protected function restoreCommonStocks()
    {
        $this->setStock(2,1,1000);
        $this->setStock(1,1,1000);
        $this->setStock(2,2,1000);
        $this->setStock(1,2,1000);
        $this->setStock(3,3,1000);
        $this->setStock(1,4,1000);
        $this->setStock(5,4,500);
        $this->setStock(10,4,300);
        $this->setStock(15,4,200);
        $this->setStock(20,4,20);
        $this->setStock(25,4,20);
        $this->setStock(5,5,1000);
        $this->setStock(6,6,1000);
        $this->setStock(7,7,1000);
        $this->setStock(1,8,1000);
        $this->setStock(5,8,1000);
        $this->setStock(10,8,300);
        $this->setStock(15,8,100);
        $this->setStock(20,8,2);
        $this->setStock(1,9,1000);
        $this->setStock(1,10,1000);
        $this->setStock(2, 4, 0);
        $this->setStock(2, 8, 0);

    }

}