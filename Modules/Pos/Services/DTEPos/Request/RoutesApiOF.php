<?php

namespace Modules\Pos\Services\DTEPos\Request;

class RoutesApiOF
{
    public const API_ROUTE = 'https://dev-api.haulmer.com/v2/dte';
    public const TAXPAYER_ENDPOINT = self::API_ROUTE . '/taxpayer';
    public const SEND_DTE_ENDPOINT = self::API_ROUTE . '/document';
    public const GET_DATA_DOCUMENT_ENDPOINT = self::API_ROUTE . '/document';

}

