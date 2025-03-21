<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongUploadAPI extends Model
{    use HasFactory;
    protected $table = 'song_upload_a_p_i_s';

    protected $fillable = ['SongPath', 'SongType'];
}
