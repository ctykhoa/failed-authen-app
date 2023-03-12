<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'shipping_address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateUser($data)
    {
        $updatedData = [];
        if (isset($data['email'])) {
            $updatedData['email'] = $data['email'];
        }
        if (isset($data['phone'])) {
            $updatedData['phone'] = $data['phone'];
        }
        if (isset($data['shipping_address'])) {
            $updatedData['shipping_address'] = $data['shipping_address'];
        }
        return $this->where('id', $data['id'])
            ->update($updatedData);
    }

}
