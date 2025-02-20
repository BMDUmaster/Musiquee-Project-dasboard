<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function googleLogin(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->token);
        $customer = Customer::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'profile_image' => $googleUser->getAvatar()
        ]);
        $token = $customer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User authenticated successfully',
            'user' => $customer,
            'token' => $token
        ]);
    }

    public function facebookLogin(Request $request)
    {
        $facebookUser = Socialite::driver('facebook')->stateless()->userFromToken($request->token);

        $customer = Customer::updateOrCreate([
            'email' => $facebookUser->getEmail(),
        ], [
            'name' => $facebookUser->getName(),
            'facebook_id' => $facebookUser->getId(),
        ]);
        $token = $customer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User authenticated successfully',
            'user' => $customer,
            'token' => $token  // Return Bearer Token
        ]);
    }
}
