<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function login(string $email, string $password)
    {
        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return 0;
        }

        $userCookie = Hash::make('myapp' . Session::token());
        Cookie::queue('user', $userCookie, 60);
        Session::put('username', explode('@', $email)[0]);

        return 1;
    }

    public function logout()
    {
        Cookie::queue(Cookie::forget('user'));
        Session::regenerateToken();
        Session::forget('username');

        return true;
    }

    public static function isAuthenticated(): bool
    {
        return Hash::check('myapp' . Session::token(), Cookie::get('user'));
    }
}


