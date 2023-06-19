<?php

namespace App\Traits;

trait ApiResponser
{

    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = 'Data not found', $code = 404)
    {
        return response()->json([
            'message' => $message,
            'data' => null
        ], $code);
    }
}

// Reference:
// https://gist.github.com/Cerwyn/f9056ecfd76ec99d089cb327d38c176c#file-apiresponser-php