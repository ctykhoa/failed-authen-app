<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function login(string $username, string $password)
    {
        $user = User::where('username', $username)
            ->select('username', 'email', 'password', 'id')
            ->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return 0;
        }

        $userCookie = Hash::make('myapp' . Session::token());
        Cookie::queue('user', $userCookie, 60);
        Session::put('username', $username);
        Session::put('user_id', $user->id);

        return 1;
    }

    public function logout()
    {
        Cookie::queue(Cookie::forget('user'));
        Session::regenerateToken();
        Session::forget('username');
        Session::forget('user_id');

        return true;
    }

    public static function isAuthenticated(): bool
    {
        return Hash::check('myapp' . Session::token(), Cookie::get('user'));
    }
}


