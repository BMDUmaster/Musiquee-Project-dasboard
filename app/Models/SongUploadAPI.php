<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongUploadAPI extends Model
{
    use HasFactory;
    protected $fillable = [
        'song_name',
        'file_path',
        'song_type',
    ];
}
