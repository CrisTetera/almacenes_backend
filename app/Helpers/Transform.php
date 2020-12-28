<?php

namespace App\Helpers;

class Transform
{

    public static function transformNullsToEmptyString(array $arr) : array
    {
        return array_map(function($el) {
            if (is_null($el))
            {
                return "";
            }
            return $el;
        }, $arr);
    }

    public static function transformNullableArray(array $arr) : array
    {
        return is_null($arr) ? [] : $arr;
    }

}
