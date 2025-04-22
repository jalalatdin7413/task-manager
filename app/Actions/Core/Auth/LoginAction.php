<?php

namespace App\Actions\Core\Auth;

use App\Dto\Auth\LoginDto;
use App\Enums\TokenAbilityEnum;
use App\Exceptions\ApiResponseException;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoginAction
{
    use ResponseTrait;

    public function __invoke(LoginDto $dto): JsonResponse
    {
        try {
            $user = User::where('phone', $dto->phone)->firstOrFail();

            if (! Hash::check($dto->password, $user->password)) {
                throw new ApiResponseException('Parol qa\'te kiritilgen', 401);
            }

            auth()->login($user);

            $accessTokenExpiration = now()->addMinutes(config('sanctum.at_expiration', env('ACCESS_TOKEN_EXPIRES_IN', 60)));
            $refreshTokenExpiration = now()->addMinutes(config('sanctum.rt_expiration', env('REFRESH_TOKEN_EXPIRES_IN', 1440)));

            $accessToken = auth()->user()->createToken(
                name: 'access token',
                abilities: [TokenAbilityEnum::ACCESS_TOKEN->value],
                expiresAt: $accessTokenExpiration
            );

            $refreshToken = auth()->user()->createToken(
                name: 'refresh token',
                abilities: [TokenAbilityEnum::ISSUE_ACCESS_TOKEN->value],
                expiresAt: $refreshTokenExpiration
            );

            return static::toResponse(
                message: "Sistemag'a a'wmetli kirdin'iz",
                data: [
                    'access_token' => $accessToken->plainTextToken,
                    'refresh_token' => $refreshToken->plainTextToken,
                    'at_expired_at' => $accessTokenExpiration->format('Y-m-d H:i:s'),
                    'rf_expired_at' => $refreshTokenExpiration->format('Y-m-d H:i:s'),
                ]
            );
        } catch (ModelNotFoundException) {
            throw new ApiResponseException('Bunday paydalaniwshi tabilmadi', 404);
        }
    }
}
