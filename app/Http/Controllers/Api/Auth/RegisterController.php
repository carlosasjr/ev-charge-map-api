<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = $user->createToken('app_token')->plainTextToken;

            return response()->json(['token' => $token]);

        } catch (\Exception $e) {
            logger('Message logged from RegisterController.create', [$e->getMessage()]);
            return response()->json(['error' => 'Something went wrong register the user'], $e->getCode());
        }

    }
}
