<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Modules\Pos\Services\DTE\Exceptions\ResponseFromOFException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        switch($exception) {
            case $exception instanceof ValidationException:
                return $this->handleValidationException($exception);
                break;
            case $exception instanceof ResponseFromOFException:
                return $this->handleResponseFromOFException($exception);
                break;
            case $exception instanceof ModelNotFoundException:
                return $this->handleModelNotFoundException($exception);
                break;
            case $exception instanceof MethodNotAllowedHttpException:
                return $this->handleMethodNotAllowedHttpException($exception);
                break;
            case $exception instanceof NotFoundHttpException:
                return $this->handleMethodNotFoundHttpException($exception);
                break;
            case $exception instanceof AuthenticationException:
                return $this->handleAuthenticationException($exception);
                break;
            default:
                return $this->handleException($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * Handle Validation Exception
     *
     * @param ValidationException $ex
     * @return Response
     */
    private function handleValidationException(ValidationException $ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 422,
            'message' => 'Ha ocurrido un error de validación de los parámetros enviados al servidor',
            'errors' => $ex->errors(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 422);
    }

    /**
     * Handle ResponseFromOFException Exception (Open Facturar errors)
     *
     * @param ResponseFromOFException $ex
     * @return Response
     */
    private function handleResponseFromOFException(ResponseFromOFException $ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 500,
            'message' => 'Error al generar DTE desde Open Factura',
            'errors' => $ex->dteResponse['error'],
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 500);
    }

    /**
     * Handle ModelNotFoundException
     *
     * @param ModelNotFoundException $ex
     * @return Response
     */
    private function handleModelNotFoundException(ModelNotFoundException $ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 500,
            'message' => 'Modelo consultado no existe en la base de datos',
            "error" => $ex->getMessage(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 500);
    }

    /**
     * Handle MethodNotAllowedHttpException
     *
     * @param MethodNotAllowedHttpException $ex
     * @return Response
     */
    private function handleMethodNotAllowedHttpException(MethodNotAllowedHttpException $ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 500,
            'message' => 'El verbo utilizado no está permitido para la ruta especificada',
            "error" => $ex->getMessage(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 500);
    }

    /**
     * Handle AuthenticationException
     *
     * @param AuthenticationException $ex
     * @return Response
     */
    private function handleAuthenticationException(AuthenticationException $ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 401,
            'message' => 'No Autorizado',
            "error" => $ex->getMessage(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 401);
    }

    /**
     * Handle handleMethodNotFoundHttpException
     *
     * @param AuthenticationException $ex
     * @return Response
     */
    private function handleMethodNotFoundHttpException(NotFoundHttpException $ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 404,
            'message' => 'Ruta no encontrada',
            "error" => $ex->getMessage(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 404);
    }

    /**
     * Handle Default Exception
     *
     * @param ValidationException $ex
     * @return Response
     */
    private function handleException($ex) {
        return response()->json([
            'status' => 'error',
            'http_status_code' => 500,
            "message" => "Ha ocurrido un error en el servidor",
            "error" => $ex->getMessage(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "trace" => $ex->getTrace(),
        ], 500);
    }

}
