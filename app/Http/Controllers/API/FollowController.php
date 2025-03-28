<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\followUpModel;

use App\Models\userregister;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller



{
    public function getUserData(Request $request){
        $userId = Auth::guard('api')->user();

        if(!$userId) {
            return response()->json([
                'status'=> false,
                'message'=>'User Not Found'
            ],404);
        }

        return response()->json(['status' => true, 'user' => $userId]);
    }

    public function follow(Request $request) {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized. Please login.'], 401);
        }

        $request->validate([
            'following_id' => 'required|exists:userregisters,id',
        ]);

        if ($user->id == $request->following_id) {
            return response()->json([
                "status"=>false,
                'message' => 'You cannot follow yourself.'
            ], 400);
        }

        $existingFollow = FollowUpModel::where('follower_id', $user->id)
            ->where('following_id', $request->following_id)
            ->exists();

        if ($existingFollow) {
            return response()->json([
                "status"=>false,
                'message' => 'You are already following this user.'
            ], 409);
        }

        FollowUpModel::create([
            'user_id' => $user->id,
            'userName' => $user->userName ?? 'Unknown User',
            'follower_id' => $user->id,
            'following_id' => $request->following_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully followed the user.'
        ], 201);
    }

    public function unfollow(Request $request) {
        $user = Auth::guard('api')->user();

        $request->validate([
            'following_id' => 'required|exists:userregisters,id',
        ]);

        $follow = FollowUpModel::where('follower_id', $user->id)
            ->where('following_id', $request->following_id)
            ->first();

        if (!$follow) {
            return response()->json(['message' => 'You are not following this user.'], 404);
        }

        $follow->delete();

        return response()->json(['message' => 'Successfully unfollowed the user.'], 200);
    }
}




