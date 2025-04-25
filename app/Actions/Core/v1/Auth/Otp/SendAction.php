<?php

namespace App\Actions\Core\v1\Auth\Otp;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseTrait;

class SendAction
{
    use ResponseTrait;

    public function __invoke(array $data): JsonResponse
    {
        $phone = $data['phone'];

        $code = rand(1000, 9999);

        Cache::put('code_' . $phone, $code, now()->addMinutes(10));

        Log::info("Tasdiqlash kodi: {$code} - foydalanuvchi: {$phone}");

        return $this->success("Tasdiqlash kodi yuborildi", [
            'code' => $code 
        ]);
    }
}
