<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function success(string $message, array $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function error(string $message, int $status = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $status);
    }
}