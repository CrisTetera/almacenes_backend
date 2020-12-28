<?php

namespace Modules\Pos\Services\DTE\Request;

use GuzzleHttp\Client;

class GetDTE_DataFromOF
{   
    // TODO: add Comments
    public function getDTE_Data($documentToken, $value = 'status')
    {
        $client = new Client([
            'base_uri' => RoutesApiOF::API_ROUTE,
        ]);

        $response = $client->request('GET', RoutesApiOF::GET_DATA_DOCUMENT_ENDPOINT . "/$documentToken/$value", [
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
        
        $payload = $response->getBody()->getContents();

        return [
            'status' => 'success',
            'message' => 'Get DTE Data Successful',
            'payload' => isset($payload) ? json_decode($payload, true) : null,
        ];
    } // end function

} // end class
