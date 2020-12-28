<?php

namespace Modules\Warehouse\Tests\Unit\WhProduct;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadLogoWhProductTest extends TestCase
{

    /**
     * Function to assert an error
     *
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    private function assertError($response, $code = 500) {
        $response->assertStatus($code)
                 ->assertJson([
                     'status' => 'error'
                 ]);
    }

    /**
     * Should throw exception if no logo is sended
     *
     * @return void
     */
    public function test_ShouldThrowException_IfNoLogoIsSended()
    {
        $response = $this->json('POST', 'api/wh_product/1/logo', [
        ]);
        $this->assertError($response, 422);
    }

    /**
     * Should throw exception if logo is bigger than 1 mb
     *
     * @return void
     */
    public function test_ShouldThrowException_IfLogoIsBigger_Than1MB()
    {
        $response = $this->json('POST', 'api/wh_product/1/logo', [
            'logo' => UploadedFile::fake()->image('logo.png')->size(1500)
        ]);
        $this->assertError($response, 422);
    }

    /**
     * Should throw exception if logo is not jpg, jpeg of png
     *
     * @return void
     */
    public function test_ShouldThrowException_IfLogoIsNotImage()
    {
        $response = $this->json('POST', 'api/wh_product/1/logo', [
            'logo' => UploadedFile::fake()->create('logo.pdf', 500)
        ]);
        $this->assertError($response, 422);
    }

    /**
     * Should be ok upload photo
     *
     * @return void
     */
    public function testLogoUpload()
    {
        $response = $this->json('POST', 'api/wh_product/1/logo', [
            'logo' => UploadedFile::fake()->image('logo.png')->size(10)
        ]);
        $obj = json_decode( $response->content() );
        $path = str_replace("/storage", "public", $obj->path);
        Storage::assertExists($path);
        return $path;
    }

    /**
     * Should be ok upload photo
     *
     * @depends testLogoUpload
     * @return void
     */
    public function testRemoveOldLogoUpload($oldPath)
    {
        $response = $this->json('POST', 'api/wh_product/1/logo', [
            'logo' => UploadedFile::fake()->image('logo.png')->size(10)
        ]);
        $obj = json_decode( $response->content() );
        $path = str_replace("/storage", "public", $obj->path);
        Storage::assertExists($path);
        Storage::assertMissing($oldPath);
    }

}
