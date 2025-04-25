<?php

namespace App\Http\Controllers;

use App\Actions\Core\v1\Auth\GetMeAction;
use App\Actions\Core\v1\Auth\LoginAction;
use App\Actions\Core\v1\Auth\LogoutAction;
use App\Actions\Core\v1\Auth\RefreshTokenAction;
use App\Actions\Core\v1\Auth\RegisterAction;
use App\Dto\Auth\LoginDto;
use App\Dto\Core\Auth\RegisterDto;
use App\Http\Requests\Core\Auth\LoginRequest;
use App\Http\Requests\Core\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        return $action(RegisterDto::from($request));
    }

    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        return $action(LoginDto::from($request));
    }

    public function refreshToken(RefreshTokenAction $action): JsonResponse
    {
        return $action();
    }

    public function me(GetMeAction $action): JsonResponse
    {
        return $action();
    }

    public function logout(LogoutAction $action): JsonResponse
    {
        return $action();
    }


}
