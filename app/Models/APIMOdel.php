<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class APIMOdel extends Model
{
    use HasFactory, HasApiTokens ;

    protected $table = 'api_registrations';


    protected $fillable = ['name', 'email', 'phone', 'address'];
    protected $hidden = [ 'remember_token'];
}
