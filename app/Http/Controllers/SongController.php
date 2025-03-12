<?php

namespace App\Http\Controllers;

use App\Models\SongPlay;
use Illuminate\Http\Request;

class SongController extends Controller
{
   public function SongOpen(){
      $getdata = SongPlay::all();
    return view('Song',compact('getdata'));
   }

   public function SongUpload(Request $request){
      $request->validate([
       'song_name'=>'required',
       'user_id'=>'required',
       'music_file'=>'required',
       'category_id'=>'required'
      ]);
        if($request->hasFile('music_file')){
          $getfile = $request->music_file;
          $changename = time().'.'.$getfile->getClientOriginalExtension();
          $getfile->move(public_path('SongFile'), $changename);
        }
      $songFile = new SongPlay();
      $songFile->songname = $request->song_name;
      $songFile->User_ID	= $request->user_id;
      $songFile->UploadFile = $changename;
      $songFile->categeryID = $request->category_id;
      $songFile->save();
      return redirect()->back()->with('success','File is Upload successfully');
   }
}
