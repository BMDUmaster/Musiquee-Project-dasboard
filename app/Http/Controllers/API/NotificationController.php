<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        $user = User::find($request->user_id);
        $user->notify(new SendNotification($request->message));

        return response()->json(['success' => 'Notification sent successfully']);
    }

    public function getNotifications($user_id)
{
    $user = User::find($user_id);

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    return response()->json($user->notifications);
}

}
