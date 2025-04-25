<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:new,in_progress,done',
            'deadline' => 'nullable|date',
        ];
    }
}