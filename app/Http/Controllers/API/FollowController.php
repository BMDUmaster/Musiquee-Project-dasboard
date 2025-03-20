<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIMOdel;
use App\Models\FollwUpModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function getUserData(Request $request){
      $userId = Auth::user();

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


  public function follow(Request $request)
  {
      $user = auth()->guard('api')->user();

      if (!$user) {
          return response()->json(['message' => 'Unauthorized. Please login.'], 401);
      }

      $request->validate([
          'following_id' => 'required|exists:api_registrations,id',
      ]);

      if ($user->id == $request->following_id) {
          return response()->json([
             "status"=>false,
            'message' => 'You cannot follow yourself.'], 400);
      }

      $existingFollow = FollwUpModel::where('follower_id', $user->id)
                                     ->where('following_id', $request->following_id)
                                     ->exists();

      if ($existingFollow) {
          return response()->json(
            [
                "status"=>false,
            'message' => 'You are already following this user.'], 409);
      }

      FollwUpModel::create([
          'user_id'=>$user->id,
          'UserName'=>$user->name,

          'follower_id' => $user->id,

          'following_id' => $request->following_id,
      ]);

      return response()->json([
        'status'=>true,
        'message' => 'Successfully followed the user.'], 201);
  }




  // Unfollow User
  public function unfollow(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'following_id' => 'required|exists:api_registrations,id',
    ]);

    $follow = FollwUpModel::where('follower_id', $user->id)
                           ->where('following_id', $request->following_id)
                           ->first();

    if (!$follow) {
        return response()->json(['message' => 'You are not following this user.'], 404);
    }

    $follow->delete();

    return response()->json(['message' => 'Successfully unfollowed the user.'], 200);
}



  public function getFollowersAndFollowing($userId)
{
    $followers = FollwUpModel::where('following_id', $userId)
                              ->with('followerUser')
                              ->get();

    $following = FollwUpModel::where('follower_id', $userId)
                              ->with('followingUser')
                              ->get();

    return response()->json([
        'followers' => $followers,
        'following' => $following,
    ]);
}
}






