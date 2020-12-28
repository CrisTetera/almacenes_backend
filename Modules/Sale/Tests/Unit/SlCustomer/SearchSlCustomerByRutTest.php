<?php

namespace Modules\Sale\Tests\Unit\SlCustomer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchSlCustomerByRutTest extends TestCase
{
    public $rutInDB = '76430498-5';
    public $rutInOFWithAllParams = '78885550-8'; //PC FACTORY
    public $rutInOFExpectingParams = '76795561-8'; // HAULMER
    public $rutNotInDBAndOF = '123456789-0';

    public $rut = '';

    /**
     * Function to call a HTTP GET Request to search a customer by rut
     *
     * @return void
     */
    private function searchCustomer() {
        return $this->json('GET', 'api/sl_customer/rut/'.$this->rut);
    }

    /**
     * Function to assert a 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response, $code = 500) {
        $response->assertStatus($code)
                 ->assertJson([
                     'status' => 'error',
                     'http_status_code' => $code
                 ]);
    }

    /**
     * Should return customer from database
     *
     * @return void
     */
    public function test_shouldReturnCustomer_IfExistsInDatabase()
    {
        $this->rut = $this->rutInDB;
        $response = $this->searchCustomer();
        $response->assertStatus(200)
                 ->assertJson([
                     'customer' => [
                         'id' => 1,
                         'rut' => $this->rut
                     ]
                 ]);
    }

    /**
     * Should return customer from Open Factura, save into database and return it
     *
     * @return void
     */
    public function test_shouldReturnCustomer_FromOF_SaveIt_AndReturnIt()
    {
        $this->rut = $this->rutInOFWithAllParams;
        $response = $this->searchCustomer();

        $obj = json_decode( $response->content() );

        $response->assertStatus(200)
                 ->assertJson([
                    'customer' => [
                        'rut' => $this->rut
                    ]
                 ]);

        $this->assertDatabaseHas('sl_customer',[
            'id' => $obj->customer->id,
            'rut' => $this->rut,
            'sl_customer_account_id' => $obj->customer->sl_customer_account_id,
            'flag_delete' => false
        ]);

        $this->assertDatabaseHas('sl_customer_account',[
            'id' => $obj->customer->sl_customer_account_id,
            'sl_customer_id' => $obj->customer->id,
            'debt_amount' => 0,
            'flag_delete' => false
        ]);
    }

    /**
     * Should return customer from Open Factura, save into database and return it
     *
     * @return void
     */
    public function test_shouldReturnCustomer_FromOF_AndReturnItWithExpectingParams()
    {
        $this->rut = $this->rutInOFExpectingParams;
        $response = $this->searchCustomer();
        $obj = json_decode( $response->content() );

        $response->assertStatus(200)
                 ->assertJson([
                    'customer' => [
                        'rut' => $this->rut
                    ]
                 ]);

        $this->assertDatabaseHas('sl_customer',[
            'id' => $obj->customer->id,
            'rut' => $this->rut,
            'sl_customer_account_id' => $obj->customer->sl_customer_account_id,
            'flag_delete' => false
        ]);

        $this->assertDatabaseHas('sl_customer_account',[
            'id' => $obj->customer->sl_customer_account_id,
            'sl_customer_id' => $obj->customer->id,
            'debt_amount' => 0,
            'flag_delete' => false
        ]);

    }

    /**
     * Should return not found if customer is not present in DB and OF
     *
     * @return void
     */
    public function test_shouldReturnModelNotFoundException_IfCustomerDoesntExists()
    {
        $this->rut = $this->rutNotInDBAndOF;
        $response = $this->searchCustomer();
        $this->assertError($response, 404);
    }

}
