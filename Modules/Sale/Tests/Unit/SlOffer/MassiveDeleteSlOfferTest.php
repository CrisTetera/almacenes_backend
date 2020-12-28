<?php

namespace Modules\Sale\Tests\SlOffer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Modules\Sale\Entities\SlOfferPos;

class MassiveDeleteSlOfferTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * Test error for request without sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithoutSlOffersArray()
    {
        SlOfferPos::whereIn('id',[1,2,3,5,7])->update([
            'flag_delete' => false
        ]);
        $jsonParam = $this->getRequestParams();
        unset($jsonParam['sl_offers']);

        $response = $this->json('PATCH', 'api/massive_delete_offer', $jsonParam);
        $this->assertErrorValidation($response);
    }
    
    /**
     * Test error for request with invalid id subindex sl_offers array param.
     *
     * @return void
     */
    public function testFailedRequest_WithInvalidDataType_SlOffersArray()
    {
        $jsonParam = $this->getRequestParams();
        $jsonParam['sl_offers'][0] = "string";
        
        $response = $this->json('PATCH', 'api/massive_delete_offer', $jsonParam);
        
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
        $jsonParam['sl_offers'][0] = -1;

        $response = $this->json('PATCH', 'api/massive_delete_offer', $jsonParam);

        $this->assertErrorValidation($response);
    }

    /**
     * Test success for request with Massive Edit SlOffer 
     *
     * @return void
     */
    public function testSuccessMassiveEditRequest()
    {
        $jsonParam = $this->getRequestParams();

        $response = $this->json('PATCH', 'api/massive_delete_offer', $jsonParam);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
        
        // Assert sl_offer flag delete = true
        foreach($jsonParam['sl_offers'] as $slOfferId) {
            $this->assertDatabaseHas('sl_offer_pos', [
                'id' => $slOfferId,
                'flag_delete' => true
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
        return array('sl_offers' => [1, 2, 3, 5, 7]);
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
}
