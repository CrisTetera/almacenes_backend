<?php

namespace Modules\Pos\Services\DTE\Request;

use GuzzleHttp\Client;
use Modules\Pos\Services\DTE\Request\RoutesApiOF;

class GetTaxPayerFromApiOF
{
    /**
     * Return a customer stored in Open Factura.
     * If doesn't exists, return null.
     *
     * @param string $rut
     * @return mixed
     */
    public function getTaxPayer($rut)
    {   
        try
        {
            $client = new Client([
                'base_uri' => RoutesApiOF::API_ROUTE,
            ]);

            $response = $client->request('GET', RoutesApiOF::TAXPAYER_ENDPOINT.'/'.$rut, [
                'decode_content' => false,
                'timeout' => 30,
                'allow_redirects' => [
                    'max' => 5,
                ],
                'headers' => [
                    'Content-type' => 'application/json',
                    'Accept' => 'application/json',
                    'apikey' => '928e15a2d14d4a6292345f04960f4bd3',
                    'Accept-Encoding' => 'gzip'
                ],
            ]);

            $customer = json_decode( $response->getBody()->getContents() );
            return $customer;
        }
        catch(\Exception $e)
        {
            return null;
        } // end function
    } // end function

} // end class
