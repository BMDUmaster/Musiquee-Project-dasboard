<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class ApiArtistModel extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'api_artist_models';
    protected $fillable = ['name','Username','BioGraph','Date','Socialmedia'];

}
