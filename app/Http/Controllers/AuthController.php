<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Return a success response with the created user
            return response()->json(['user' => $user], 201);
        } catch (ValidationException $e) {
            // Return a response with validation errors
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            // Log the error or return it in the response for debugging
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();

        // Set expiration time for the token (e.g., 1 day from now)
        $expirationTime = now()->addMinutes(595);


        // Create a token with the specified expiration time
        $token = $user->createToken('authToken', ['expires_at' => $expirationTime])->plainTextToken;

        return response()->json(['token' => $token, 'expires_at' => $expirationTime], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
