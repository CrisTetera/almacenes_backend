<?php

namespace Modules\General\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GMenuModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_get_menu_module_user_without_param_g_module_id()
    {
        $response = $this->json('GET', 'api/get_menu_module_user');

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_get_menu_module_user_failed_not_exist_param_g_module_id()
    {
        $json = [
            "g_module_id" => -1,
        ];

        $response = $this->json('GET', 'api/get_menu_module_user', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_failed_get_menu_module_user_failed_not_integer_param_g_module_id()
    {
        $json = [
            "g_module_id" => "error",
        ];

        $response = $this->json('GET', 'api/get_menu_module_user', $json);

        $this->assertErrorValidation($response);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_get_menu_module_user()
    {
        $json = [
            "g_module_id" => 1,
        ];

        $response = $this->json('GET', 'api/get_menu_module_user', $json);

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
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
