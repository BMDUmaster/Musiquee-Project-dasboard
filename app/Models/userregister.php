<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class userregister extends Model
{
    use HasFactory, HasApiTokens,Notifiable;
    protected $fillable = ['userName','phone','email','bio','socialLinks','profileImage','password',];
    protected $primaryKey = 'user_Id';
}
