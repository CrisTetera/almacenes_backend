<?php

namespace Modules\Sale\Tests\SlOffer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MassiveCreateSlOfferTest extends TestCase
{
    
    use WithoutMiddleware;
    /**
     * Test error for request without wh_products param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutWhProducts()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['wh_products']);

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request without branch_office_id param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutName()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['name']);

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with invalid data type for branch_office_id param.
     *
     * @return void
     */
    public function testFailedRequest_InvalidDataTypeName()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['name'] = [1, 2, 3]; // must to be a string

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    
    /**
     * Test error for request without init_datetime param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutInitDatetime()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['init_datetime']);

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    
    /**
     * Test error for request with invalid init_datetime param.
     *
     * @return void
     */
    public function testFailedRequest_InvalidInitDatetime()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['init_datetime'] = "string";

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with past init_datetime param.
     *
     * @return void
     */
    public function testFailedRequest_PastInitDatetime()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['init_datetime'] = \Carbon\Carbon::now()->subDays(1)->format('Y-m-d');
        
        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request without finish_datetime param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutFinishDatetime()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['finish_datetime']);

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    
    /**
     * Test error for request with invalid finish_datetime param.
     *
     * @return void
     */
    public function testFailedRequest_InvalidFinishDatetime()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['finish_datetime'] = "string";

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with past finish_datetime param.
     *
     * @return void
     */
    public function testFailedRequest_PastFinishDatetime()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['init_datetime'] = \Carbon\Carbon::now()->addDays(5)->format('Y-m-d');
        $jsonParam['finish_datetime'] = \Carbon\Carbon::now()->addDays(4)->format('Y-m-d');
        
        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with invalid data type string in wh_products param (must to be bidimentional array of Integers).
     *
     * @return void
     */
    public function testFailedRequest_InvalidDataType_String_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = 'string';

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with invalid data type array structure in wh_products param (must to be bidimentional array of Integers).
     *
     * @return void
     */
    public function testFailedRequest_InvalidDataType_ArrayStructure_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = array(
            [ 
                "id" => 1, 
                "offer_price" => 500,
                "invalid_index" => 10, // this filed is not valid
            ],
            [ 
                "id" => 2, 
                "offer_price" => 600,
                "invalid_index" => 10, // this filed is not valid
            ],
        );

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with invalid data type Ids of products in wh_products param (must to be bidimentional array of Integers).
     *
     * @return void
     */
    public function testFailedRequest_InvalidDataType_SubIndexId_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = array(
            [ 
                "id" => 1, 
                "offer_price" => 500,
            ],
            [ 
                "id" => 2.5,  // invalid => must to be only integer (or string of integer) 
                "offer_price" => 600,
            ],
        );

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with invalid data type offer_price of products in wh_products param (must to be bidimentional array of Integers).
     *
     * @return void
     */
    public function testFailedRequest_InvalidDataType_SubIndexOfferPrice_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = array(
            [ 
                "id" => 1, 
                "offer_price" => 500,
            ],
            [ 
                "id" => 2.0,  // invalid => must to be only integer (or string of integer) 
                "offer_price" => "string",
            ],
        );

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with not exist in DB wh_products param (must to exist in DB).
     *
     * @return void
     */
    public function testFailedRequest_IndexNotExistInDB_WhProducts()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['wh_products'] = [
            [ 
                "id" => 1, 
                "offer_price" => 500,
            ],
            [ 
                "id" => -1, 
                "offer_price" => 600,
            ]
        ];

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    /**
     * Test success for request with WhProducts with already SlOffer
     *
     * @return void
     */
    public function testSuccessMassiveCreateRequest_AndExistSomeSlOffers()
    {
        $jsonParam = $this->getRequestParams();

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 201,
            'data' => [
                'quantitySlOfferDeleted' => 5,
            ],
        ]);

        // Assert sl_offer
        foreach($jsonParam['wh_products'] as $product) {
            $this->assertDatabaseHas('sl_offer_pos', [
                'wh_product_id' => $product['id'],
                'offer_price' => $product['offer_price'],
                'init_datetime' => $jsonParam['init_datetime'],
                'finish_datetime' => $jsonParam['init_datetime'],
                'flag_delete' => false
            ]);
        } // end function
    }

    /**
     * Test success for request with WhProducts without SlOffer
     *
     * @return void
     */
    public function testSuccessMassiveCreateRequest_AndNotExistSlOffers()
    {
        $jsonParam = $this->getRequestParams();
        // Delete Offer of WhProduct to test
        \DB::table('sl_offer_pos')->whereIn('wh_product_id', [1, 2, 3, 5, 7])->where('flag_delete', 0)->update(['flag_delete' => true]);

        $response = $this->json('POST', 'api/massive_create_offer', $jsonParam);
        // dump($response);
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 201,
            'data' => [
                'quantitySlOfferDeleted' => 0,
            ],
        ]);

        // Assert sl_offer
        foreach($jsonParam['wh_products'] as $product) {
            $this->assertDatabaseHas('sl_offer_pos', [
                'wh_product_id' => $product['id'],
                'offer_price' => $product['offer_price'],
                'name' => $jsonParam['name'],
                'init_datetime' => $jsonParam['init_datetime'],
                'finish_datetime' => $jsonParam['finish_datetime'],
                'flag_delete' => false
            ]);
        } // end function
    }

    /**
     * Get right request Params 
     *
     * @return array
     */
    public function getRequestParams()
    {
        return [
            'wh_products' => [
                [ 
                    "id" => 1, 
                    "offer_price" => 500,
                ],
                [ 
                    "id" => 2, 
                    "offer_price" => 600,
                ],
                [ 
                    "id" => 3, 
                    "offer_price" => 700,
                ],
                [ 
                    "id" => 5, /** Offer of wh_product with ID = 5 with flag_delete true (no apply for this test) **/  
                    "offer_price" => 800,
                ],
                [ 
                    "id" => 7, /** Offer of wh_product with ID = 6 with flag_delete true (no apply for this test) **/
                    "offer_price" => 900,
                ],
            ],
            'name' => 'Offer from test',
            'init_datetime' => date('Y-m-d'),
            'finish_datetime' => date('Y-m-d'),
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
    } // end function

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
    } // end function

}
