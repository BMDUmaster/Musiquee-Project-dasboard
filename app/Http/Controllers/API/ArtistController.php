<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApiArtistModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    //artist get API
   public function ArtistUpload(Request $request){

    $validate = Validator::make($request->all(),[
        'name'=>'required',
        'Username'=>'required',
        'BioGraph'=>'required',
        'Date'=>'required',
        'Socialmedia'=>'required|array'
    ]);

    if($validate->fails()){
        return response()->json([
            'status'=>false,
            'message'=>'Validation Faild',
            'Error'=>$validate->errors()->all()
        ]);
    }

    $socialmediaJson = json_encode($request->Socialmedia);

    $UploadData = ApiArtistModel::create([
                  'name'=>$request->name,
                  'Username'=>$request->Username,
                  'BioGraph'=>$request->BioGraph,
                  'Date'=>$request->Date,
                  'Socialmedia'=>$socialmediaJson

    ]);

       $token = $UploadData->createToken('ArtistToken')->plainTextToken;
      return response()->json([
            'status'=>true,
            'message'=>"artist save successfully",
            'Artist' => $UploadData ,
            'token'=>$token
      ],200);

   }

   public function GetArtistData(Request $request){

    $artistData = ApiArtistModel::all();
      if( $artistData->isEmpty()){
        return response()->json([
            'status'=>false,
            'message'=>"Artist Not Found",

        ],405);
      }
      else{
        return response()->json([
            'status'=>true,
            'Message'=>"Artist Found Successfully",
             'data' => $artistData
        ],200);
      }

   }

   public function UpdateArtist(Request $request, $id)
   {
       // Check if Artist exists
       $artist = ApiArtistModel::find($id);
       if (!$artist) {
           return response()->json([
               'status' => false,
               'message' => "Artist Not Found",
           ], 404);
       }

       // Validation
       $validator = Validator::make($request->all(), [
           'name' => 'sometimes|required|string|max:255',
           'Username' => 'sometimes|required|string|max:255',
           'BioGraph' => 'sometimes|nullable|string',
           'Date' => 'sometimes|required|date',
           'Socialmedia' => 'sometimes|nullable|array',
       ]);

       if ($validator->fails()) {
           return response()->json([
               'status' => false,
               'message' => $validator->errors(),
           ], 400);
       }

       // Update Data
       $artist->update([
           'name' => $request->name,
           'Username' => $request->Username,
           'BioGraph' => $request->BioGraph,
           'Date' => $request->Date,
           'Socialmedia' => json_encode($request->Socialmedia),
       ]);

       return response()->json([
           'status' => true,
           'message' => "Artist Updated Successfully",
           'data' => $artist,
       ], 200);
   }




}
