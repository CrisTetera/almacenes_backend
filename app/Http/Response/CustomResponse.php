<?php

namespace App\Http\Response;

class CustomResponse {

    /**
     * OK Response.
     * @param array $data Array to append data
     */
    public static function ok($data = []) {
        return array_merge([
            'status' => 'success',
            'http_status_code' => 200
        ], $data);
    } 

    /**
     * Created Response.
     * @param array $data Array to append data
     */
    public static function created($data = []) {
        return array_merge([
            'status' => 'success',
            'http_status_code' => 201
        ], $data);
    } 

    /**
     * Error Response
     *
     * @param Exception $e
     * @param array $data
     * @param integer $code
     * @return array
     */
    public static function error($e, $data = [], $code = 500) {
        return array_merge([
            "status" => "error",
            'http_status_code' => $code,
            "message" => "Ha ocurrido un error en el servidor",
            "error" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine(),
        ], $data);
    }

    /**
     * Normal Error Response (No error, file or line)
     *
     * @param array $data
     * @param integer $code
     * @return array
     */
    public static function normalError($data = [], $code = 500) {
        return array_merge([
            "status" => "error",
            'http_status_code' => $code
        ], $data);
    }

}

?>