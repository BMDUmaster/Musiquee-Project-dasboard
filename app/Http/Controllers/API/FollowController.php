<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIMOdel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function getUserData(Request $request){
      $userId = Auth::user();
    //   $user = APIMOdel::find($userId);
      if(! $userId){
        return response()->json([
            'status'=> false,
            'message'=>'User Not Found'
        ],404);

      }

      $user = APIMOdel::where('email', $userId->email)->first();
      if (!$user) {
          return response()->json([
            'status' => false,

            'message' => 'User Not Found'
        ], 404);
      }

      return response()->json(['status' => true, 'user' => $user]);
  }

}
