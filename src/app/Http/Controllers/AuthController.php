<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Constructor
    function __construct(User $user, AuthService $authService)
    {
        $this->user = $user;
        $this->authService = $authService;
    }

    function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        if ($this->authService->login($username, $password)) {
            return redirect('/home');
        }

        return view('login', [
            'errorMessage' => 'Invalid login',
        ]);
    }
}
