<?php

namespace Modules\General\Tests\Unit\GUser;

use Tests\TestCase;
use Modules\HR\Entities\HrEmployee;
use Modules\General\Entities\GUser;

class CrudUserTest extends TestCase
{
    public $json = [
        'rut' => '19895712-7', // Ejemplo 12345678-0
        'names' => 'Gon',
        'last_name1' => 'Freecss',
        'last_name2' => '',
        'email' => 'gon.freecss@gmail.com',
        'role' => 3 // 3: Vendedor
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
     * @return void
     */
    private function storeUser() {
        return $this->json('POST', 'api/g_user', $this->tempJson);
    }

    /**
     * Function to call a HTTP PUT
     *
     * @return void
     */
    private function updateUser($id) {
        return $this->json('PUT', "api/g_user/$id", $this->tempJson);
    }

    /**
     * Function to call a HTTP DELETE
     *
     * @return void
     */
    private function deleteUser($id) {
        return $this->json('DELETE', "api/g_user/$id");
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
     * Test should store user
     *
     * @return void
     */
    public function test_shouldStoreUser()
    {
        $response = $this->storeUser();
        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 201
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                     'user_id',
                     'employee_id',
                     'auth_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert G User
        $this->assertDatabaseHas('g_user', [
            'id' => $obj->user_id,
            'hr_employee_id' => $obj->employee_id,
            'flag_delete' => false
        ]);
        // Asert Hr Employee
        $this->assertDatabaseHas('hr_employee', [
            'id' => $obj->employee_id,
            'rut' => $this->tempJson['rut'],
            'names' => $this->tempJson['names'],
            'last_name1' => $this->tempJson['last_name1'],
            'last_name2' => $this->tempJson['last_name2'],
            'email' => $this->tempJson['email'],
            'flag_delete' => false
        ]);
        // Assert Model Has Roles
        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $this->tempJson['role'],
            'model_id' => $obj->user_id
        ]);
        return $obj->user_id;
    }

    /**
     * Test should throw exception if user doesnt exists in database when updating
     *
     * @depends test_shouldStoreUser
     * @return void
     */
    public function test_ShouldThrowException_IfUserDoesntExists_WhenUpdate($id)
    {
        $response = $this->updateUser(-1);
        $this->assertError($response);
    }

    /**
     * Test should update user
     *
     * @depends test_shouldStoreUser
     * @return void
     */
    public function test_ShouldUpdateUser($id)
    {
        $this->tempJson = [
            'rut' => '19895712-7', // Ejemplo 12345678-0
            'names' => 'Killua',
            'last_name1' => 'Zoldyck',
            'last_name2' => '',
            'email' => 'killua.zoldyck@gmail.com',
            'role' => 3 // 3: Vendedor
        ];
        $response = $this->updateUser($id);
        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'http_status_code' => 200
                ])
                ->assertJsonStructure([
                    'status',
                    'http_status_code',
                ]);
        $obj = json_decode( $response->content() );

        // Asert Hr Employee
        $user = GUser::where('id', $id)->first();
        $employee = HrEmployee::where('id', $user->hr_employee_id)->first();
        $this->assertDatabaseHas('hr_employee', [
            'id' => $employee->id,
            'rut' => $this->tempJson['rut'],
            'names' => $this->tempJson['names'],
            'last_name1' => $this->tempJson['last_name1'],
            'last_name2' => $this->tempJson['last_name2'],
            'email' => $this->tempJson['email'],
            'flag_delete' => false
        ]);
    }

    /**
     * Test should throw exception if user doesn´t exists in database when deleting
     *
     * @depends test_shouldStoreUser
     * @return void
     */
    public function test_ShouldThrowException_IfUserDoesntExists_WhenDelete($id)
    {
        $response = $this->deleteUser(-1);
        $this->assertError($response);
    }

    /**
     * Test should delete logically user
     *
     * @depends test_shouldStoreUser
     * @return void
     */
    public function test_ShouldDeleteUser($id)
    {
        $response = $this->deleteUser($id);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'http_status_code' => 200
                 ])
                 ->assertJsonStructure([
                     'status',
                     'http_status_code',
                 ]);
        $obj = json_decode( $response->content() );

        // Assert G User
        $this->assertDatabaseHas('g_user', [
            'id' => $id,
            'flag_delete' => true
        ]);
        // Assert Hr Employee
        $user = GUser::where('id', $id)->first();
        $employee = HrEmployee::where('id', $user->hr_employee_id)->first();
        $this->assertDatabaseHas('hr_employee', [
            'id' => $employee->id,
            'flag_delete' => true
        ]);
    }
}
