<?php

namespace App\Exceptions;

use Exception;

class ApiResponseException extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
            'status' => $this->getCode(),
        ], $this->getCode());
    }
}
