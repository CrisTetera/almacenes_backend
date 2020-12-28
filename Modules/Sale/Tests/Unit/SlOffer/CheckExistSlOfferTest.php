<?php

namespace Modules\Sale\Tests\SlOffer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\General\Entities\GUserPos;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CheckExistSlOfferTest extends TestCase
{
    use WithoutMiddleware;
    // /**
    //  * Constant ID User to login
    //  */
    // private const ID_USER = 1;    

    // /**
    //  * Reset tempJson after each test
    //  *
    //  * @return void
    //  */
    // protected function setUp() : void {
    //     parent::setUp();
    //     $this->tempJson = $this->json;

    //     $user = GUserPos::find(self::ID_USER);
    //     $this->actingAs($user, 'api');
    // }
    /**
     * Test error for request without wh_products param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutWhProducts()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['wh_products']);

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        // dump($response);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid datatype wh_products param (must be Integer).
     *
     * @return void
     */
    public function testFailedRequest_InvalidDataType_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = 'this is a string';

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid wh_products param (must be Integer Array).
     *
     * @return void
     */
    public function testFailedRequest_InvalidArrayDataType_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = [1, 2, '3', 4, 'this is a test'];

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid wh_products param (must to exist in DB).
     *
     * @return void
     */
    public function testFailedRequest_IndexNotExistInDB_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = -1;

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid wh_products array param (must to exist all Index in Integer Array ).
     *
     * @return void
     */
    public function testFailedRequest_IndexInArrayNotExistInDB_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = [1, 2, '3', 4, -1];

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Test success for request with WhProducts with active SlOffer
     *
     * @return void
     */
    public function testSuccessRequest_ExistSlOffer_ForOneWhProduct()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = 1;

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
            'data' => [
                'check_exist_offer' => true,
            ],
        ]);
    }
    
    /**
     * Test success for request with Array of WhProducts with some active SlOffer
     *
     * @return void
     */
    public function testSuccessRequest_ExistSlOffer_ForArrayWhProduct()
    {
        $jsonParam = $this->getRequestParams();

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
            'data' => [
                'check_exist_offer' => true,
            ],
        ]);
    }
    
    /**
     * Test success for request with WhProducts without active SlOffer 
     *
     * @return void
     */
    public function testSuccessRequest_NotExistSlOffer_ForOneWhProduct()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = 4; // product without offer

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
            'data' => [
                'check_exist_offer' => false,
            ],
        ]);
    }
    
    /**
     * Test success for request with Array of WhProducts without nothing active SlOffer 
     *
     * @return void
     */
    public function testSuccessRequest_NotExistSlOffer_ForArrayWhProduct()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = [4, 6]; // product without offer

        $response = $this->json('GET', 'api/check_exist_sl_offer', $jsonParam);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
            'data' => [
                'check_exist_offer' => false,
            ],
        ]);
    }
    
    /**
     * Get right request Params 
     *
     * @return array
     */
    public function getRequestParams()
    {
        return [
            'wh_products' => [1, '2', 3, '4', 5],  //should accept integer and string integer
        ];
    }

    /**
     * Function to assert and 500 error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response)
    {
        $response->assertStatus(500)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    } // end foreach

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
    
} // end function
