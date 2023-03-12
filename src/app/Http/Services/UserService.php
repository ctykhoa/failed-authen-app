<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserProfile()
    {
        $userId = Session::get('user_id');
        return User::where('id', $userId)
            ->select('email', 'username', 'phone', 'id', 'shipping_address', 'created_at')
            ->first();
    }

    public function updateUserProfile($data)
    {
        $data['id'] = Session::get('user_id');

        return $this->user->updateUser($data);
    }
}
