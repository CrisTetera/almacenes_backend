<?php

namespace Modules\General\Tests\Unit\GUser;

use Tests\TestCase;
use Modules\Sale\Entities\SlGroundSeller;
use Dotenv\Exception\ValidationException;
use Modules\General\Entities\GUser;
use Modules\HR\Entities\HrEmployee;

class GroundSellerCustomersTest extends TestCase
{
    public $json = [
        'rut' => '14367359-6', // Ejemplo 12345678-0
        'names' => 'Hisoka',
        'last_name1' => 'Morow',
        'last_name2' => '',
        'email' => 'hisoka.morow@gmail.com',
        'role' => 3, // 3: Vendedor
        'is_ground_seller' => true,
        'customers' => [1, 2, 3, 4, 5]
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
     * Test should store user
     *
     * @return void
     */
    public function test_shouldStoreUser()
    {
        $response = $this->storeUser();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
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
        // Assert sl ground seller
        $this->assertDatabaseHas('sl_ground_seller', [
            'hr_employee_id' => $obj->employee_id,
            'flag_delete' => false
        ]);
        $groundSeller = SlGroundSeller::where('hr_employee_id', $obj->employee_id)->first();
        // Assert sl customer ground seller
        foreach($this->tempJson['customers'] as $customerId)
        {
            $this->assertDatabaseHas('sl_customer_ground_seller', [
                'sl_ground_seller_id' => $groundSeller->id,
                'sl_customer_id' => $customerId
            ]);
        }

        return $obj->user_id;
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
            'role' => 3, // 3: Vendedor
            'customers' => [2, 3, 4]
        ];
        $response = $this->updateUser($id);
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
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
         // Assert sl ground seller
         $this->assertDatabaseHas('sl_ground_seller', [
            'hr_employee_id' => $employee->id,
            'flag_delete' => false
        ]);
        // Assert sl customer ground seller
        $groundSeller = SlGroundSeller::where('hr_employee_id', $employee->id)->first();
        foreach($this->tempJson['customers'] as $customerId)
        {
            $this->assertDatabaseHas('sl_customer_ground_seller', [
                'sl_ground_seller_id' => $groundSeller->id,
                'sl_customer_id' => $customerId
            ]);
        }
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
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
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
         // Assert sl ground seller
         $this->assertDatabaseHas('sl_ground_seller', [
            'hr_employee_id' => $employee->id,
            'flag_delete' => true
        ]);
        // No customers
        $groundSeller = SlGroundSeller::where('hr_employee_id', $employee->id)->first();
        $this->assertDatabaseMissing('sl_customer_ground_seller', [
            'sl_ground_seller_id' => $groundSeller->id
        ]);
    }

    /**
     * Test should store user
     *
     * @return void
     */
    public function test_shouldStoreUser_Case2()
    {
        $this->tempJson['rut'] = '23029871-8';
        $this->tempJson['customers'] = [8, 9, 10];
        $response = $this->storeUser();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
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
        // Assert sl ground seller
        $this->assertDatabaseHas('sl_ground_seller', [
            'hr_employee_id' => $obj->employee_id,
            'flag_delete' => false
        ]);
        $groundSeller = SlGroundSeller::where('hr_employee_id', $obj->employee_id)->first();
        // Assert sl customer ground seller
        foreach($this->tempJson['customers'] as $customerId)
        {
            $this->assertDatabaseHas('sl_customer_ground_seller', [
                'sl_ground_seller_id' => $groundSeller->id,
                'sl_customer_id' => $customerId
            ]);
        }

        return $obj->user_id;
    }

    /**
     * Test should store user
     *
     * @return void
     */
    public function test_ShouldThrowException_IfCustomerIsTaken()
    {
        // $this->expectException(ValidationException::class);
        $this->tempJson['rut'] = '20078001-9';
        $this->tempJson['customers'] = [8, 20, 30];
        $response = $this->storeUser();
        dump( json_decode($response->content(), JSON_PRETTY_PRINT) );
        $response->assertStatus(500)
                ->assertJson([
                    'status' => 'error',
                    'http_status_code' => 500
                ]);
    }

}
