<?php

namespace App\Http\Services;

class ErrorService
{
    public function throwNotFoundError()
    {
         return response()->view('errors.not_found', [], 404);
    }
}
