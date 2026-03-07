<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Return a success JSON response
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Return an error JSON response
     */
    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}