<?php

namespace App\Http\Controllers;

use App\Models\artistModel;
use Illuminate\Http\Request;

class artistController extends Controller
{
   public function artist(){
     $getArtist = artistModel::all();
    return view('artist',compact('getArtist'));
   }


   public function artistLogic(Request $request){

      $request->validate([
          'name'=>'required',
          'username'=>'required|unique:artist_models',
          'date'=>'required|date|after_or_equal:today',
          'bio'=>'required',
          'links' => 'required',
          'links.*' => 'required|url'
      ]);

    $artistdata = new artistModel();
    $artistdata->name = $request->name;
    $artistdata->Username = $request->username;
    $artistdata->Date =$request->date;
    $artistdata->BioGraph = $request->bio;
    $artistdata->Socialmedia = json_encode($request->links);
    $artistdata->save();
    return redirect()->back()->with('success','Data is saved successfully');


   }
}
