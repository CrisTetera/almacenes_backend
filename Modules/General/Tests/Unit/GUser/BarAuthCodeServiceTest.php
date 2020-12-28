<?php

namespace Modules\General\Tests\Unit\GUser;

use Tests\TestCase;

class BarAuthCodeServiceTest extends TestCase
{

    public $json = [
        'g_user_id' => 1
    ];

    public $tempJson;

    /**
     * Reset tempJson after each test
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        $this->tempJson = $this->json;
    }

    /**
     * Function to call a HTTP POST
     *
     * @property string $role
     * @return void
     */
    private function recoverBarAuthCode($role) {
        return $this->json('POST', "api/authorization/$role/recover", $this->tempJson);
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
     * Test should throw exception if role doesnt exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfRoleDoesntExists()
    {
        $response = $this->recoverBarAuthCode('some_random_role');
        $this->assertError($response);
    }

    /**
     * Test should throw exception if user doesnt exists
     *
     * @return void
     */
    public function test_ShouldThrowException_IfUserDoesntExists()
    {
        $this->tempJson['g_user_id'] = 99999;
        $response = $this->recoverBarAuthCode('pos_supervisor');
        $this->assertError($response);
    }

    /**
     * Test should recover bar auth code
     *
     * @return void
     */
    public function test_ShouldRecoverBarAuthCode()
    {
        $response = $this->recoverBarAuthCode('pos_supervisor');
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'bar_auth_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert Wh Family
        $this->assertDatabaseHas('g_user', [
            'id' => $this->tempJson['g_user_id'],
            'bar_auth_code' => $obj->bar_auth_code,
            'flag_delete' => false
        ]);
    }

}
