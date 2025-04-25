<?php

namespace App\Actions\Core\v1\Auth;

use App\Http\Resources\Core\Auth\GetMeResource;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class GetMeAction
{
    use ResponseTrait;

    public function __invoke(): JsonResponse
{
    if (!auth()->check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return static::toResponse(
        data: new GetMeResource(auth()->user())
    );
}

}