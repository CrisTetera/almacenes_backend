<?php

namespace Modules\General\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_success_get_menu_module_user()
    {
        $response = $this->json('GET', 'api/get_all_modules_user');

        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200,
        ]);
    }
}
