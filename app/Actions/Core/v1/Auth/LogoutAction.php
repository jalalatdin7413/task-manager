<?php

namespace App\Actions\Core\v1\Auth;

use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class LogoutAction
{
    use ResponseTrait;

    public function __invoke(): JsonResponse
    {
        auth()->user()?->tokens()?->delete();

        return static::toResponse(
            message: "You're logged out"
        );
    }
}
