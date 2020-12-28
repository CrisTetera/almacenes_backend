<?php

namespace Modules\Sale\Tests\Unit\SlOffer;

use Tests\TestCase;

class GetLastSlSaleInvoice_OpenCashDeskTest extends TestCase
{
    public $tempJson;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
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
     * Test should throw exception if unset cash_des_id
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_Unset_CashDeskId()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['cash_desk_id']);
        $response = $this->json('GET', 'api/get_last_sale_invoice_open_cash_desk', $jsonParam);
        $this->assertErrorValidation($response);
    }

    /**
     * Test should throw exception if invalid datatype cash_des_id
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_InvalidDatatype_CashDeskId()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['cash_desk_id'] = 'string';
        $response = $this->json('GET', 'api/get_last_sale_invoice_open_cash_desk', $jsonParam);
        $this->assertErrorValidation($response);
    }

    /**
     * Test should throw exception if doesn't exist in cash_desk_id
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_NotExistInDB_CashDeskId()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['cash_desk_id'] = -1;
        $response = $this->json('GET', 'api/get_last_sale_invoice_open_cash_desk', $jsonParam);        
        $this->assertErrorValidation($response);
    }

    /**
     * Test should throw exception if no open cash_desk cash_des_id
     *
     * @return void
     */
    public function test_ShouldThrowExceptionIf_NotOpenCashDesk_CashDeskId()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['cash_desk_id'] = 2; // 2 no open (from seeds)
        $response = $this->json('GET', 'api/get_last_sale_invoice_open_cash_desk', $jsonParam);        
        $this->assertError($response);
    }

    /**
     * Test success Get List of SlSaleInvoice of open PosCashDesk
     *
     * @return void
     */
    public function test_ShouldGetSlSaleInvoice()
    {
        $jsonParam = $this->getRequestParams();
        $response = $this->json('GET', 'api/get_last_sale_invoice_open_cash_desk', $jsonParam);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'data',
                 ]);
    }

    /**
     * Get Json params of request
     * 
     * @return array
     */
    private function getRequestParams()
    {
        return [
            'cash_desk_id' => 1,
        ];
    } // end functions


}
