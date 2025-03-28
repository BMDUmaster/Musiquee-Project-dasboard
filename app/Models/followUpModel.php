<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class followUpModel extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'user_id',
        'UserName',
        'follower_id',
        'following_id',
    ];

    public function followerUser()
    {
        return $this->belongsTo(userregister::class, 'follower_id');
    }

    public function followingUser()
    {
        return $this->belongsTo(userregister::class, 'following_id');
    }
}
