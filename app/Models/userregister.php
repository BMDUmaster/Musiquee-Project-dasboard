<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class userregister extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'userName',
        'phone',
        'email',
        'bio',
        'socialLinks',
        'role',
        'profileImage',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
