<?php

namespace Modules\Warehouse\Tests\Unit\WhProduct;

use Tests\TestCase;

class SuggestCodeTest extends TestCase
{
    // $response = $this->json('POST', 'api/wh_product/1/logo', [
        // ]);

    public function test_ShouldSuggest_UPC_Code()
    {
        $response = $this->json('GET', 'api/wh_product/suggest_upc_code');
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200
        ])->assertJsonStructure([
            'status',
            'http_status_code',
            'suggested_code'
        ]);
        $obj = json_decode( $response->content() );

        $this->assertEquals( 12, strlen($obj->suggested_code) );
    }

    public function test_ShouldSuggest_Internal_Code_Case1()
    {
        $family_id = 2;
        $subfamily_id = 1;
        $product_name = 'Manjar Colún';
        $response = $this->json('GET', "api/wh_product/suggest_internal_code?family_id=$family_id&subfamily_id=$subfamily_id&product_name=$product_name");
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200
        ])->assertJsonStructure([
            'status',
            'http_status_code',
            'suggested_code'
        ]);
        $obj = json_decode( $response->content() );

        $this->assertEquals( "002001MANJ003", $obj->suggested_code );
    }

    public function test_ShouldSuggest_Internal_Code_Case2()
    {
        $family_id = 3;
        $subfamily_id = 6;
        $product_name = 'sal lobos';
        $response = $this->json('GET', "api/wh_product/suggest_internal_code?family_id=$family_id&subfamily_id=$subfamily_id&product_name=$product_name");
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200
        ])->assertJsonStructure([
            'status',
            'http_status_code',
            'suggested_code'
        ]);
        $obj = json_decode( $response->content() );

        $this->assertEquals( "003006SAL001", $obj->suggested_code );
    }

    public function test_ShouldSuggest_Internal_Code_Case3()
    {
        $family_id = 1234;
        $subfamily_id = 6789;
        $product_name = 'sal lobos de 100 gr';
        $response = $this->json('GET', "api/wh_product/suggest_internal_code?family_id=$family_id&subfamily_id=$subfamily_id&product_name=$product_name");
        $response->assertJson([
            'status' => 'success',
            'http_status_code' => 200
        ])->assertJsonStructure([
            'status',
            'http_status_code',
            'suggested_code'
        ]);
        $obj = json_decode( $response->content() );

        $this->assertEquals( "123678SAL001", $obj->suggested_code );
    }


}
