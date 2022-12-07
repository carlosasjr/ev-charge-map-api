<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'These credentials do not match our records.'], 404);
        }

        $token = $user->createToken('app_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }



    public function me()
    {
        return response()->json(auth()->user(), 200);
    }

    public function logout()
    {
        //Remove all tokens client
        auth()->user()->tokens()->delete();

        return response()->json([], 204);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6|max:12',
        ]);

        $user = $request->user();

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Password reseted succesfully'], 200);
    }
}
