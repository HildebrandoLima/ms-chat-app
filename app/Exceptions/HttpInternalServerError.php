<?php

namespace App\Exceptions;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class HttpInternalServerError
{
    public static function getResponse(string $details): Response
    {
        Log::error("Error: [" . $details . "]");
        return response()->json([
            "message" => DefaultErrorMessages::DATABASE_QUERY_ERROR,
            "data" => [],
            "status" => Response::HTTP_INTERNAL_SERVER_ERROR,
            "details" => $details,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
