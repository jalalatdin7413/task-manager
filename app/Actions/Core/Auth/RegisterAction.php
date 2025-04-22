<?php

namespace App\Actions\Core\Auth;

use App\Actions\Core\Auth\Otp\SendAction;
use App\Dto\Core\Auth\RegisterDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    use ResponseTrait;

    public function __construct()
    {
        $this->sendAction = new SendAction;
    }

    public function __invoke(RegisterDto $dto): JsonResponse
    {
        $data = [
            'country_id' => $dto->countryId,
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'password' => Hash::make($dto->password),
        ];

        Cache::put('user_' . $dto->phone, $data, now()->addHour());

        return ($this->sendAction)($data);
    }
}