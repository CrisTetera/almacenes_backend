<?php

namespace Modules\General\Tests\Unit\GTemporalModuleToken;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\General\Entities\GUser;

class GenerateGTemporalModuleTest extends TestCase
{
    /**
     * Constant ID User to login
     */
    private const ID_USER = 1;
    /**
     * Setup a user for test
     * 
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $user = GUser::find(self::ID_USER);
        $this->be($user);
    } // end function
    
    /**
     * Test failed login unset RUT.
     *
     * @return void
     */
    public function testFailed_UnsetUserToken()
    {
        $json = $this->getJsonParam();
        unset($json['user_token']);
        $response = $this->json('POST', 'api/auth/generate_temporal_module_token', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login Invalid RUT (Chilean RUT).
     *
     * @return void
     */
    public function testFailedLogin_InvalidUserToken()
    {
        $json = $this->getJsonParam();
        $json['user_token'] = [];
        $response = $this->json('POST', 'api/auth/generate_temporal_module_token', $json);
        $this->assertErrorValidation($response);
    }


    /**
     * Test Success login with remember me True
     *
     * @return void
     */
    public function testSuccess_GenerateGTemporalModuleToken()
    {
        $json = $this->getJsonParam();
        $response = $this->json('POST', 'api/auth/generate_temporal_module_token', $json);
        $arrResponse = json_decode($response->content(), true);

        // Assert JSON values
        $response->assertStatus(201)
                 ->assertJson([
                    'status' => 'success',
                ]);
        
        // Assert wh_transfer_between_warehouse
        $this->assertDatabaseHas('g_temporal_module_token', [
            'module_token' => $arrResponse['module_token'],
            'user_token' => $json['user_token'],
            'g_user_id' => self::ID_USER,
        ]);        
    }

    /**
     * Get params for Login Request
     * 
     * @return array params
     */
    private function getJsonParam()
    {
        return [
            'user_token' => '123456789abcdefghi',
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
     * Function to assert and 401 error (unauthorized)
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertErrorUnauthorized($response)
    {
        $response->assertStatus(401)
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
