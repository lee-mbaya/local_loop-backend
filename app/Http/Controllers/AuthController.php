<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Logout method
    public function logout(Request $request)
    {
        // Invalidate all tokens for the authenticated user
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        // Return a response to confirm the user has been logged out
        return response()->json(['message' => 'Logged out successfully.']);
    }
}

