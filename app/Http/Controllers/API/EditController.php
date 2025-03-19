<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APIMOdel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EditController extends Controller

    {
        public function updateUser(Request $request, $id)
        {

            $validate = Validator::make($request->all(), [
                'name'=>'sometimes|required|string|max:255',
                'email'=>'sometimes|required|email|unique:api_registrations,email,' . $id,
                'phone'=>'sometimes|required|digits:10|unique:api_registrations,phone,' . $id,
                'address'=>'nullable|string|max:500',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validate->errors()->all()
                ], 422);
            }

            // Find the user
            $user = APIMOdel::find($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Update user details
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->name ?? $user->email,
                'phone' => $request->phone ?? $user->phone,
                'address' => $request->address ?? $user->address,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully!',
                'user' => $user
            ], 200);
        }
    }
