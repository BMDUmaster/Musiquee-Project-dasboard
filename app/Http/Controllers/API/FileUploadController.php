<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SongUploadAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
   public function UploadSong(Request $request){
    $validate=Validator::make($request->all(),[
        'song_type' => 'required|string|in:Pop,Rock,Jazz,Classical,HipHop',
        'songFile'=>'required|mimesmp3,wav,ogg',
    ]);
    if($validate->fails()){
        return response()->json([
            'status'=>false,
            'message'=>'Validation error',
            'error'=>$validate->errors()->all()
        ],400);

    }
         if($request->hasFile('songFile')){
               $getfile = $request->file('songFile');
               $fileName = time().'_'.$getfile->getClientOriginalName();
               $getfile->move(public_path('MySong'),$fileName);

               $song = SongUploadAPI::create([
                'song_name' => $fileName ,

                'song_type' => $request->song_type,
               ]);
               return response()->json([
                'status'=>true,
                'message'=>'Song Upload Successfully',
                'file_path'=> url('MySong/'.$fileName),
                'upload'=>$song

               ],200);
            }
           return response()->json([
            'status'=>false,
            'message'=>'File Upload Failed.',

           ],500);

   }
}
