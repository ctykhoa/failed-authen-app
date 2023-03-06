<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function login($email, $password)
    {
        // SQL injection
        $user = DB::select(DB::raw("SELECT email, password
                                        FROM users
                                        WHERE email = '$email'
                                        AND password = '$password'
                                        LIMIT 1
                                        "));

        if (!$user) {
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


