<?php

namespace Modules\General\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Modules\General\Entities\GUser;
use Hash;
use DB;

class AuthResetPasswordTest extends TestCase
{
    /**
     * User for test reset pass
     * @var Modules\General\Entities\GUser
     */
    var $user;
    
    /**
     * String for make token
     * @const string
     */
    const STRING_TOKEN = '123456789';

    /**
     * Set user for test
     * 
     * @return void
     */
    protected function setUp() 
    {
        parent::setUp();
        $this->user = GUser::find(1);
    }

    /**
     * Test failed Reset Password unset RUT.
     *
     * @return void
     */
    public function testFailedLogin_UnsetRut()
    {
        $json = $this->getJsonParam();
        unset($json['rut']);
        $response = $this->json('POST', 'api/auth/password/reset', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password Invalid RUT (Chilean RUT).
     *
     * @return void
     */
    public function testFailedLogin_InvalidRut()
    {
        $json = $this->getJsonParam();
        $json['rut'] = 'invalid';
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password RUT not exist in DB.
     *
     * @return void
     */
    public function testFailedLogin_RutNotExistInDB()
    {
        $json = $this->getJsonParam();
        $json['rut'] = '17295365-4';
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password unset Password.
     *
     * @return void
     */
    public function testFailedLogin_UnsetPassword()
    {
        $json = $this->getJsonParam();
        unset($json['password']);
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password short password (min is 6 chars).
     *
     * @return void
     */
    public function testFailedLogin_ShortPassword()
    {
        $json = $this->getJsonParam();
        $json['password'] = '12345';
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password Unset password_repeat (min is 6 chars).
     *
     * @return void
     */
    public function testFailedLogin_UnsetPasswordRepeat()
    {
        $json = $this->getJsonParam();
        unset($json['password_repeat']);
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password short password_repeat (min is 6 chars).
     *
     * @return void
     */
    public function testFailedLogin_ShortPasswordRepeat()
    {
        $json = $this->getJsonParam();
        $json['password_repeat'] = '12345';
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password diff password and password_repeat (min is 6 chars).
     *
     * @return void
     */
    public function testFailedLogin_DiffPasswordAndPasswordRepeat()
    {
        $json = $this->getJsonParam();
        $json['password'] = 'secret2';
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed Reset Password unset token.
     *
     * @return void
     */
    public function testFailedLogin_UnsetToken()
    {
        $json = $this->getJsonParam();
        unset($json['token']);
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test Success Reset Password with remember me True
     *
     * @return void
     */
    public function testSuccessResetPassword()
    {
        $this->createPasswordReset();
        $json = $this->getJsonParam();
        $response = $this->json('POST', 'api/auth/password/reset', $json);
        $arrResponse = json_decode($response->content(), true);

        // Assert JSON values
        $response->assertStatus(200)
                 ->assertJson([
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
     * Create Password Reset for user 1
     * 
     * @return void
     */
    function createPasswordReset()
    {
        DB::table('password_resets')->insert([
            'email' => $this->user->hrEmployee->email,
            'token' => Hash::make(self::STRING_TOKEN),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    } // end function

    /**
     * Get params for Login Request
     * 
     * @return array params
     */
    private function getJsonParam()
    {
        return [
            'rut' => $this->user->hrEmployee->rut,
            'password' => 'secret',
            'password_repeat' => 'secret',
            'token' => self::STRING_TOKEN,
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
