<?php

namespace Modules\Sale\Http\Requests\SlOffer\CustomValidations;

class SlOfferCustomValidation
{
    /**
     * Check if input para is a array of integers
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public static function isIntegerOrArrayInteger($attribute, $value, $parameters)
    {
        if(! isInt($value) && ! self::isIntegerArray($value) )
            return false;
        
        return true;
    } // end function

    /**
     * Check if input para is a array of integers
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public static function existsFromArray($attribute, $value, $parameters)
    {        
        if(
            ! self::isIntegerOrArrayInteger($attribute, $value, $parameters) || 
            ! self::checkAllArrayInDB($value, $parameters) 
        )
            return false;
        
        return true;
    } // end function

    /**
     * Check if input param have the correct format: 
     * 
     * [
     *      "id" => 1,
     *      "offer_price" => 500,
     * ], ...
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public static function checkArrayStructureCreateMassive($attribute, $value, $parameters)
    {
        if(! self::isValidArrayCreateMassive($value))
            return false;

        return true;
    } // end function

    /**
     * Check if input param have the correct format: 
     * 
     * [ 
     *      "id" => 1, 
     *      "offer_price" => 500,
     *      "init_datetime" => date('Y-m-d'),
     *      "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
     * ],
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public static function checkArrayStructureEditMassive($attribute, $value, $parameters)
    {
        if(! self::isValidArrayEditMassive($value))
            return false;

        return true;
    } // end function

    /**
     * Check if products in array massive exists in DB
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public static function existsFromArrayCreateMassive($attribute, $value, $parameters)
    {
        // Pass massive array to Only integer array of Products Ids
        foreach($value as $subArray) $arrProductsIds[] = $subArray['id'];

        if(
            ! self::isIntegerOrArrayInteger($attribute, $arrProductsIds, $parameters) || 
            ! self::checkAllArrayInDB($arrProductsIds, $parameters) 
        )
            return false;
        
        return true;
    } // end function

    /**
     * Check if sl_offer exist in array massive exists in DB
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    public static function existsFromArrayEditMassive($attribute, $value, $parameters)
    {
        // Pass massive array to Only integer array of Products Ids
        foreach($value as $subArray) $arrOffersIds[] = $subArray['id'];
        if(
            ! self::isIntegerArray($arrOffersIds) || 
            ! self::checkAllArrayInDB($arrOffersIds, $parameters) 
        )
            return false;
        
        return true;
    } // end function

    /**
     * Check if input para is a array of integers
     * 
     * @param mixed arrayInteger
     * @return bool
     */
    private static function isIntegerArray($arrayInteger)
    {
        if(is_array($arrayInteger)) {
            foreach($arrayInteger as $elementArray) {
                if (! isInt($elementArray))
                    return false;
            }

            return true;
        }

        return false;
    } // end function

    /**
     * Check if input array of Ids param, exist in DB (for table and column specified in $parametersDB)
     * 
     * @param mixed arrayInteger
     * @return bool
     */
    private static function checkAllArrayInDB($arrayInteger, $parametersDB)
    {
        try {
            $table = $parametersDB[0];
            $column = $parametersDB[1];

            if(is_int($arrayInteger)) $arrayInteger = [$arrayInteger]; // if integer, pass to array

            if(is_array($arrayInteger)) {
                foreach($arrayInteger as $elementArray) {
                    $responseDB = \DB::table($table)->where($column, intval($elementArray))->where('flag_delete', 0)->first();
                    if (! isset($responseDB)) 
                        return false;                        
                }

                return true;
            }

            return false;
        }
        catch(\Exception $e)
        {
            // Error with DB
            return false;
        } // end catch
    } // end function

    /**
     * Check if input param have the correct format: This function is private. 
     * 
     * [0] => [
     *              "id" => 1,
     *              "offer_price" => 500,
     *       ],
     * [1] => [
     *              "id" => 2,
     *              "offer_price" => 1000,
     *       ],
     * ...
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    private static function isValidArrayCreateMassive($arrayMassive)
    {
        if(is_array($arrayMassive)) {
            foreach($arrayMassive as $subArray) 
                if (! self::isValidSubArrayCreateMassive($subArray)) return false;
            
            return true;
        }

        return false;
    } // end function

    /**
     * Check if input param have the correct format: This function is private. 
     * 
     * [0] => [ 
     *      "id" => 1, 
     *      "offer_price" => 500,
     *      "init_datetime" => date('Y-m-d'),
     *      "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
     * ],
     * [1] => [ 
     *      "id" => 1, 
     *      "offer_price" => 500,
     *      "init_datetime" => date('Y-m-d'),
     *      "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
     * ],
     * ...
     * 
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @return bool
     */
    private static function isValidArrayEditMassive($arrayMassive)
    {
        if(is_array($arrayMassive)) {
            foreach($arrayMassive as $subArray) 
                if (! self::isValidSubArrayEditMassive($subArray)) return false;
            
            return true;
        }

        return false;
    } // end function


    /**
     * Check if subarray of array create massive is Valid. Format:
     * 
     * [
     *      "id" => 2,
     *      "offer_price" => 1000,
     * ],
     * 
     * @param mixed $subarray (must to be a array)
     * @return bool
     */
    private static function isValidSubArrayCreateMassive($subArray)
    {
        if (
            is_array($subArray) && count($subArray) === 2 && 
            isset($subArray['id']) && isset($subArray['offer_price']) &&
            isInt($subArray['id']) && isInt($subArray['offer_price'])
        )
            return true;
        
        return false;
    } // end function

    /**
     * Check if subarray of array edit massive is Valid. Format:
     * 
     * [ 
     *      "id" => 1, 
     *      "offer_price" => 500,
     *      "init_datetime" => date('Y-m-d'),
     *      "finish_datetime" => date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')),
     * ],
     * 
     * @param mixed $subarray (must to be a array)
     * @return bool
     */
    private static function isValidSubArrayEditMassive($subArray)
    {
        $today = date('Y-m-d');
        if (
            is_array($subArray) && count($subArray) === 4 && 
            isset($subArray['id']) && isset($subArray['offer_price']) && isset($subArray['init_datetime']) && isset($subArray['finish_datetime']) &&
            isInt($subArray['offer_price']) && verifyDate($subArray['init_datetime'], 'Y-m-d') && verifyDate($subArray['finish_datetime'], 'Y-m-d') &&
            $subArray['init_datetime'] >= $today && $subArray['finish_datetime'] >= $subArray['init_datetime'] 
        )
            return true;
        
        return false;
    } // end function




}