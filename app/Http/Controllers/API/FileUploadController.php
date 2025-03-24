<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SongUploadAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
   public function UploadSong(Request $request){
    $validate=Validator::make($request->all(),[
        'SongType' => 'required|string|in:Pop,Rock,Jazz,Classical,HipHop',
        'SongPath'=>'required|mimes:mp3,wav,ogg',
    ]);
    if($validate->fails()){
        return response()->json([
            'status'=>false,
            'message'=>'Validation error',
            'error'=>$validate->errors()->all()
        ],400);

    }


         if($request->hasFile('SongPath')){
               $getfile = $request->file('SongPath');
               $fileName = time().'_'.$getfile->getClientOriginalName();
               $getfile->move(public_path('MySong'),$fileName);

               $song = SongUploadAPI::create([
                'SongPath' => $fileName ,

                'SongType' => $request->SongType,
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

    public function deleteSong($id)
    {
        // Find the song by ID
        $song = SongUploadAPI::find($id);

        if (!$song) {
            return response()->json([
                'status' => false,
                'message' => 'Song not found'
            ], 404);
        }

        // Delete the song
        $song->delete();

        return response()->json([
            'status' => true,
            'message' => 'Song deleted successfully'
        ], 200);
    }

}


