<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class FollwUpModel extends Model
{
    use HasFactory , HasApiTokens;
    protected $fillable = ['user_id', 'follower_id', 'following_id'];

    // Follower User Relation
    public function followerUser()
    {
        return $this->belongsTo(APIMOdel::class, 'follower_id');
    }

    // Following User Relation
    public function followingUser()
    {
       return $this->belongsTo(APIMOdel::class, 'following_id');
    }

}
