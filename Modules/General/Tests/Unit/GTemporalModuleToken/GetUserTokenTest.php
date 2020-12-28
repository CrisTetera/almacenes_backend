<?php

namespace Modules\General\Tests\Unit\GTemporalModuleToken;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\General\Entities\GTemporalModuleToken;
use DB;

class GetUserTokenTest extends TestCase
{    
    /**
     * Constant ID User to login
     */
    private const ID_USER = 1;

    /**
     * @var GTemporalModuleToken
     */
    private $gTemporalModuleToken;
    /**
     * Setup a register of GTemporalModuleToken
     * 
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->gTemporalModuleToken = $this->createGTemporalModuleToken();
    } // end function

    /**
     * Test failed login unset RUT.
     *
     * @return void
     */
    public function testFailed_UnsetModuleToken()
    {
        $json = $this->getJsonParam();
        unset($json['module_token']);
        $response = $this->json('GET', 'api/auth/get_login_token', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login Invalid RUT (Chilean RUT).
     *
     * @return void
     */
    public function testFailedLogin_InvalidModuleToken()
    {
        $json = $this->getJsonParam();
        $json['module_token'] = [];
        $response = $this->json('GET', 'api/auth/get_login_token', $json);
        $this->assertErrorValidation($response);
    }

    /**
     * Test failed login Invalid RUT (Chilean RUT).
     *
     * @return void
     */
    public function testFailedLogin_NotExistInDB_ModuleToken()
    {
        $json = $this->getJsonParam();
        $json['module_token'] = 'testing';
        $response = $this->json('GET', 'api/auth/get_login_token', $json);
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
        $response = $this->json('GET', 'api/auth/get_login_token', $json);

        // Assert json response structure
        $response->assertJsonStructure([
            'message',
            'status',
            'user' => [
                'nombre_completo',
                'email',
                'roles',
            ],
            'user_token',
        ]);
        
        // Assert JSON values
        $response->assertStatus(200)
                 ->assertJson([
                    'status' => 'success',
                    'message' => 'Autorizado',
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
            'module_token' => $this->gTemporalModuleToken->module_token,
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

    /**
     * creare a new register of GTemporalModuleToken in DB
     * 
     * @return GTemporalModuleToken|null 
     */
    private function createGTemporalModuleToken()
    {
        DB::beginTransaction();
        try
        {    
            $moduleToken = str_random(32);  //random token of 32 chars
            $gTemporalModuleToken = new GTemporalModuleToken();
            $gTemporalModuleToken->module_token = $moduleToken;
            $gTemporalModuleToken->user_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGc';
            $gTemporalModuleToken->g_user_id = self::ID_USER;
            $gTemporalModuleToken->save();

            DB::commit();

            return $gTemporalModuleToken;
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return null;
        }

    } // end function
}
