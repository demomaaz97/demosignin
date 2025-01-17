<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        // Use Socialite's Google driver to start the authentication process.
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Retrieve user details from Google after successful authentication
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Create or update the user in the database using their email address
            $user = User::updateOrCreate(
                [
                    'email' => $googleUser->getEmail(), // Match or find user by email
                ],
                [
                    'name' => $googleUser->getName(), // Update or set the user's name
                    'google_id' => $googleUser->getId(), // Store the Google ID for reference
                ]
            );

            // Generate a new personal access token for the authenticated user
            $token = $user->createToken('API Token')->plainTextToken;

            // Redirect the user to the frontend dashboard with the token in the URL
            return redirect('http://localhost:5173/dashboard?token=' . $token);
        } catch (\Exception $e) {
            // Redirect to the login page if an error occurs
            return redirect('http://localhost:5173/login')->with('error', 'Authentication failed. Please try again.');
        }
    }

}
