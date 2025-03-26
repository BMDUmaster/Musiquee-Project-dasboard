<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserSongStore extends Controller
{
public function SongStore(Request $request){
    $validate = Validator::make($request->all(),[
             'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'type' => 'required|array',
            'type.*' => 'required|in:video,audio',
            'files' => 'required|array',
            'files.*' => 'required|mimes:mp4,mov,avi,mp3,wav|max:20480',
    ]);
    if( $validate->fails()){
        return response()->json([
            'status'=>false,
            'message'=>"Validation Error ",
            'error'=>$validate->errors()->all()
        ],422);
    }
    $uploadedMedia = [];
    foreach ($request->files as $key => $file) {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('media_files', $fileName, 'public');

        $media =userSongStore::create([
            'user_id' =>  Auth::user(),
            'title' => $request->title[$key],
            'type' => $request->type[$key],
            'file_path' => $filePath,
            'content' => null,
        ]);

        $uploadedMedia[] = $media;
    }
    return response()->json([
        'status' => true,
        'message' => 'Videos uploaded successfully!',
        'data' => $uploadedMedia,
    ], 201);

 }
}
