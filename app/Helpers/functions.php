<?php

/**
 * This file contain Helpers for all ERP Agroplastic application 
 */
if (! function_exists('getArtisanCommandResponse'))
{
    function getArtisanCommandResponse()
    {
        // If you need result of console output
        $responseAsText = \Artisan::output();
        $arrLinesResponseAsText = explode(PHP_EOL, trim($responseAsText));

        $response = [];
        foreach($arrLinesResponseAsText as $lineResponseAsText)
        {
            $arrKeyValueLine = explode(':', $lineResponseAsText); // 0 => key | 1 => value
            $response[$arrKeyValueLine[0]] = $arrKeyValueLine[1];
        }

        return $response;
    } // end function

} // end if

if(! function_exists('verifyDate'))
{
    function verifyDate($date, $format = 'Y-m-d H:i:s')
    {
        return (DateTime::createFromFormat($format, $date) !== false);
    } // end function
}

if(! function_exists('isInt'))
{
    function isInt($integer)
    {
        return (is_numeric($integer) ? intval($integer) == $integer : false);
    }
}

if(! function_exists('isBool'))
{
    function isBool($bool)
    {
        return is_bool($bool) || $bool === 'true' || $bool === 'false';
    }
}

if(! function_exists('isArrayOfInt'))
{
    function isArrayOfInt($array)
    {
        if(is_array($array)) {
            foreach($array as $integer)
                if(! isInt($integer) ) return false;
            return true;
        }

        return false;
    }
}

if(! function_exists('isArrayOfBoolean'))
{
    function isArrayOfBoolean($array)
    {
        if(is_array($array)) {
            foreach($array as $bool)
                if(! isBool($bool) ) return false;
            return true;
        }

        return false;
    }
}

if(! function_exists('castArrayToBool'))
{
    function castStringArray_ToBoolArray($array)
    {
        $arrBool = [];
        if(is_array($array)) {
            foreach($array as $bool)
                $arrBool[] = $bool == 'true' ? true : false;
        }
        
        return $arrBool;
    }
}

if(! function_exists('isJoined'))
{
    function isJoined($query, $table) {
        $joins = collect($query->getQuery()->joins);
        return $joins->pluck('table')->contains($table);
    }
}


if(! function_exists('addMiddlewares'))
{
    /**
     * Return array with middleware. Add "auth:api" if is Production environment
     * 
     * @param array $middlewares
     * @return array with middlewares
     */
    function addMiddlewares($middlewares = []) {
        if(App::environment('local') && isset($_GET['bypass']))
            return array('middleware' => $middlewares);

        $middlewares =  array_merge (['auth:api'], $middlewares);
        return array('middleware' => $middlewares);
    } // end function
}

if(! function_exists('getLoggedUser'))
{
    /**
     * Return array with middleware. Add "auth:api" if is Production environment
     * 
     * @param array $middlewares
     * @return array with middlewares
     */
    function getLoggedUser() {
        $defaultUserTestID = 1;
        if(App::environment('local') && isset($_GET['bypass']))    
            return Modules\General\Entities\GUserPos::find($defaultUserTestID);

        return Illuminate\Support\Facades\Auth::user();
    } // end function
}