<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class APIMOdel extends Model
{
    use HasFactory, HasApiTokens ;

    protected $table = 'api_registrations';


    protected $fillable = ['name', 'email', 'phone', 'address','password'];
    protected $hidden = [ 'remember_token'];

    public function followers()
    {
        return $this->hasMany(FollwUpModel::class, 'following_id');
    }

    // Following Relation
    public function following()
    {
        return $this->hasMany(FollwUpModel::class, 'follower_id');
    }
}
