<?php

namespace Modules\General\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class AuthLogoutTest extends TestCase
{

    /**
     * Test failed logout without user logged.
     *
     * @return void
     */
    public function testFailedLogout_WithoutUserLogged()
    {
        $response = $this->json('GET', 'api/auth/logout');
        $this->assertErrorUnauthorized($response);
    }

    /**
     * Test success logout for User with ID = 1.
     *
     * @return void
     */
    public function testSuccessLogout()
    {
        $arrResponse = $this->loginRequest();
        $headers = $this->getJWT_Headers($arrResponse); 
        $response = $this->json('GET', 'api/auth/logout', [], $headers);
        $response->assertStatus(200)
                 ->assertJson([
                    'status' => 'success',
                ]);
    }

    /**
     * Login request for user with ID=1
     * 
     * @return array with JWT
     */
    private function loginRequest() : array
    {
        $json = $this->getJsonParam_Login();
        $response = $this->json('POST', 'api/auth/login', $json);
        return json_decode($response->content(), true);
    }

    /**
     * Get headers with JWT of authenticated user
     * 
     * @param array $arrJWT with JWT
     * @return array with headers
     */
    private function getJWT_Headers(array $arrJWT) : array
    {
        return [
            'Authorization' => "{$arrJWT['token_type']} {$arrJWT['access_token']}",
        ];
    }

    /**
     * Get params for Login Request
     * 
     * @return array params
     */
    private function getJsonParam_Login() : array
    {
        return [
            'rut' => '18702940-6 ',
            'password' => 'secret',
            'remember_me' => true,
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
