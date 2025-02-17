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
        try {
            $accessToken = $request->token;

            // Validate token presence
            if (!$accessToken) {
                return response()->json(['error' => 'Access token is required'], 400);
            }
            $appSecret = env('FACEBOOK_CLIENT_SECRET');
            $appSecretProof = hash_hmac('sha256', $accessToken, $appSecret);
            $fbResponse = Http::get("https://graph.facebook.com/v17.0/me", [
                'fields' => 'id,name,email',
                'access_token' => $accessToken,
                'appsecret_proof' => $appSecretProof
            ]);

            // Check if response is valid
            if ($fbResponse->failed()) {
                Log::error('Facebook API error', ['response' => $fbResponse->json()]);
                return response()->json(['error' => 'Invalid Facebook Token or App Secret'], 401);
            }

            $facebookUser = $fbResponse->json();

            // Ensure email exists
            if (!isset($facebookUser['email'])) {
                return response()->json(['error' => 'Facebook account does not have an email'], 400);
            }

            // Create or update customer
            $customer = Customer::updateOrCreate(
                ['email' => $facebookUser['email']],
                [
                    'name' => $facebookUser['name'],
                    'facebook_id' => $facebookUser['id']
                ]
            );

            // Generate Bearer Token
            $token = $customer->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User authenticated successfully',
                'user' => $customer,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            Log::error('Facebook Login Exception', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Something went wrong. Try again.'], 500);
        }
    }
}
