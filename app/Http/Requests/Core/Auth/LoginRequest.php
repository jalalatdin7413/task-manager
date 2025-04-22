<?php

namespace App\Http\Requests\Core\Auth;

use Doctrine\Inflector\Rules\French\Rules;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array 
    {
        return [
            'phone' => 'required|numeric|exists:users,phone',
            'password' => 'required|string',
        ];
    }
}    