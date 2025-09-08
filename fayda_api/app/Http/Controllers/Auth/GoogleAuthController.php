<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Google_Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class GoogleAuthController extends Controller
{
    public function handleGoogleCallback(Request $request)
    {
        $idToken = $request->input('id_token');

        if (!$idToken) {
            return response()->json(['error' => 'ID token is required'], 400);
        }

        $client = new Google_Client(['client_id' => config('services.google.client_id')]);

        try {
            $payload = $client->verifyIdToken($idToken);

            if (!$payload) {
                return response()->json(['error' => 'Invalid ID token'], 401);
            }

            // Extract user info from token payload
            $googleId = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'] ?? null;

            // Find or create user
            $user = User::updateOrCreate(
                ['google_id' => $googleId],
                [
                    'email' => $email,
                    'name' => $name,
                    'password' => Hash::make(Str::random(16))
                ]
            );

            // Log the user in (optional)
            Auth::login($user);

            // Return a token or user data (e.g., API token)
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token verification failed: ' . $e->getMessage()], 500);
        }
    }

}
