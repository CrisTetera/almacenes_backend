<?php

namespace Modules\Pos\Services\DTE\Request;

use GuzzleHttp\Client;

class SendDteToApiOF
{   
    // TODO: add Comments
    public function sendDTE($dte)
    {
        $client = new Client([
            'base_uri' => RoutesApiOF::API_ROUTE,
            ]);

        $response = $client->request('POST', RoutesApiOF::SEND_DTE_ENDPOINT, [
            'body' => json_encode($dte),
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
            'message' => 'DTE Created Successful',
            'payload' => isset($payload) ? json_decode($payload, true) : null,
        ];
    } // end function

} // end class
