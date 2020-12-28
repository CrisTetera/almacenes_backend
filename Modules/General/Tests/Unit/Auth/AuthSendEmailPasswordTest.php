<?php

namespace Modules\General\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class AuthSendEmailPasswordTest extends TestCase
{

    /**
     * Test failed login unset RUT.
     *
     * @return void
     */
    public function testFailedLogin_UnsetRut()
    {
        $json = $this->getJsonParam();
        unset($json['rut']);
        $response = $this->json('POST', 'api/auth/login', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login Invalid RUT (Chilean RUT).
     *
     * @return void
     */
    public function testFailedLogin_InvalidRut()
    {
        $json = $this->getJsonParam();
        $json['rut'] = 'invalid';
        $response = $this->json('POST', 'api/auth/login', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login RUT not exist in DB.
     *
     * @return void
     */
    public function testFailedLogin_RutNotExistInDB()
    {
        $json = $this->getJsonParam();
        $json['rut'] = '17295365-4';
        $response = $this->json('POST', 'api/auth/login', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login unset Password.
     *
     * @return void
     */
    public function testFailedLogin_UnsetPassword()
    {
        $json = $this->getJsonParam();
        unset($json['password']);
        $response = $this->json('POST', 'api/auth/login', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login short password (min is 6 chars).
     *
     * @return void
     */
    public function testFailedLogin_ShortPassword()
    {
        $json = $this->getJsonParam();
        $json['password'] = '12345';
        $response = $this->json('POST', 'api/auth/login', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login Incorrect password (min is 6 chars).
     *
     * @return void
     */
    public function testFailedLogin_IncorrectPassword()
    {
        $json = $this->getJsonParam();
        $json['password'] = 'incorrect';
        $response = $this->json('POST', 'api/auth/login', $json);
        $this->assertErrorUnauthorized($response);
    }

    /**
     * Test failed login invalid remember me (must to be bool).
     *
     * @return void
     */
    public function testFailedLogin_InvalidRememberMe()
    {
        $json = $this->getJsonParam();
        $json['remember_me'] = 'invalid';
        $response = $this->json('POST', 'api/auth/login', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test Success login with remember me True
     *
     * @return void
     */
    public function testSuccessLogin_WithRememberMeTrue()
    {
        $json = $this->getJsonParam();
        $response = $this->json('POST', 'api/auth/login', $json);
        $arrResponse = json_decode($response->content(), true);

        // Assert JSON values
        $response->assertStatus(200)
                 ->assertJson([
                    'status' => 'success',
                ]);

        // Assert expires_at
        $this->assertTrue(
            substr($arrResponse['expires_at'], 0, 10) == Carbon::now()->addWeek()->format('Y-m-d')
        );
        
        // Assert json response structure
        $response->assertJsonStructure([
            'message',
            'status',
            'user' => [
                'nombre_completo',
                'email',
                'roles',
            ],
            'access_token',
            'token_type',
            'expires_at',
        ]);
    }

    /**
     * Test Success login with remember me False
     *
     * @return void
     */
    public function testSuccessLogin_WithRememberMeFalse()
    {
        $json = $this->getJsonParam();
        $json['remember_me'] = false;
        $response = $this->json('POST', 'api/auth/login', $json);
        $arrResponse = json_decode($response->content(), true);
        
        // Assert JSON values
        $response->assertJson([
            'status' => 'success',
        ]);

        // Assert expires_at
        $this->assertTrue(
            substr($arrResponse['expires_at'], 0, 10) == Carbon::now()->addDay()->format('Y-m-d')
        );
        
        // Assert json response structure
        $response->assertJsonStructure([
            'message',
            'status',
            'user' => [
                'nombre_completo',
                'email',
                'roles',
            ],
            'access_token',
            'token_type',
            'expires_at',
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
