<?php

namespace Modules\Sale\Tests\SlOffer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Modules\Sale\Entities\SlOfferPos;

class MassiveEditSlOfferTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * Test error for request without sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutSlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['sl_offers']);

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid id subindex sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithInvalidDataTypeId_SlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = [ 
            "id" => "string", 
            "offer_price" => 500,
            "init_datetime" => date('Y-m-d'),
            "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
        ];
        
        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid id subindex sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithInvalidDataTypeOfferPrice_SlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = [ 
            "id" => 1, 
            "offer_price" => 500.5,
            "init_datetime" => date('Y-m-d'),
            "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
        ];

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid init_datetime subindex sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithInvalidDataTypeInitDatetime_SlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = [ 
            "id" => 1, 
            "offer_price" => 500,
            "init_datetime" => "string",
            "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
        ];

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid finish_datetime subindex sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithInvalidDataTypeFinishDatetime_SlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = [ 
            "id" => 1, 
            "offer_price" => 500,
            "init_datetime" => date('Y-m-d'),
            "finish_datetime" => "string",
        ];

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid array structure for sl_offers array param (extra subarray data).
     *
     * @return void
     */
    public function testFailedRequest_WithInvalidArrayStructure_SlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = [ 
            "id" => 1, 
            "offer_price" => 500,
            "init_datetime" => date('Y-m-d'),
            "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
            "extra_param" => "string",
        ];

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    /**
     * Test error for request with some not exist sl_offer in DB (all array must to exist in DB).
     *
     * @return void
     */
    public function testFailedRequest_IndexNotExistInDB_SlOffers()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = [ 
            "id" => -1, 
            "offer_price" => 500,
            "init_datetime" => date('Y-m-d'),
            "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
        ];

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }
    
    
    /**
     * Test error for request with past init_datetime array element.
     *
     * @return void
     */
    public function testFailedRequest_PastInitDatetime_ArrayElement()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0]["init_datetime"] = date('Y-m-d', strtotime(date('Y-m-d') . ' - 1 days'));

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with past finish_datetime array element.
     *
     * @return void
     */
    public function testFailedRequest_PastFinishDatetime_ArrayElement()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0]["init_datetime"] = date('Y-m-d', strtotime(date('Y-m-d') . ' + 2 days'));
        $jsonParam['sl_offers'][0]["finish_datetime"] = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days'));
  
        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);
        
        $this->assertErrorValidation($response);
    }

    /**
     * Test success for request with Massive Edit SlOffer  with name param
     *
     * @return void
     */
    public function testSuccessMassiveEditRequest_withNameParam()
    {
        SlOfferPos::whereIn('id',[1,2,3,5,7])->update([
            'flag_delete' => false
        ]);
        $jsonParam = $this->getRequestParams();

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
        
        // Assert sl_offer
        foreach($jsonParam['sl_offers'] as $slOffer) {
            $this->assertDatabaseHas('sl_offer_pos', [
                'id' => $slOffer['id'],
                'name' => $jsonParam['name'],
                'offer_price' => $slOffer['offer_price'],
                'init_datetime' => $slOffer['init_datetime'],
                'finish_datetime' => $slOffer['finish_datetime'],
                'flag_delete' => false
            ]);
        } // end function
    }

    /**
     * Test success for request with Massive Edit SlOffer  with name param
     *
     * @return void
     */
    public function testSuccessMassiveEditRequest_withoutNameParam()
    {
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['name']); 

        $response = $this->json('PATCH', 'api/massive_edit_offer', $jsonParam);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
        
        // Assert sl_offer
        foreach($jsonParam['sl_offers'] as $slOffer) {
            $this->assertDatabaseHas('sl_offer_pos', [
                'id' => $slOffer['id'],
                'offer_price' => $slOffer['offer_price'],
                'init_datetime' => $slOffer['init_datetime'],
                'finish_datetime' => $slOffer['finish_datetime'],
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
            'sl_offers' => [
                [ 
                    "id" => 1, 
                    "offer_price" => 1000,
                    "init_datetime" => date('Y-m-d'),
                    "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
                ],
                [ 
                    "id" => 2, 
                    "offer_price" => 1000,
                    "init_datetime" => date('Y-m-d'),
                    "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
                ],
                [ 
                    "id" => 3, 
                    "offer_price" => 1000,
                    "init_datetime" => date('Y-m-d'),
                    "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
                ],
                [ 
                    "id" => 5, /**ID 4 have flag delete True, then is ignore for test  */ 
                    "offer_price" => 1000,
                    "init_datetime" => date('Y-m-d'),
                    "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
                ],
                [ 
                    "id" => 7, /**ID 6 have flag delete True, then is ignore for test  */ 
                    "offer_price" => 1000,
                    "init_datetime" => date('Y-m-d'),
                    "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
                ],
            ],
            'name' => 'Offer from edit test', // not required
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
