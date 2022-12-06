<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index()
    {
        try {
            return response()->json(auth()->user(), 200);
        } catch (\Exception $e) {
            logger('Message logged from UserController.index', [$e->getMessage()]);
            return response()->json(['error' => 'Something went wrong getting the user details'], $e->getCode());
        }
    }

    public function update(UserRequest $request)
    {
        try {

            $user = User::findOrFail(auth()->user()->id);

           logger($request->except('id'));

            $user->update($request->except('id'));

            return $user;
        } catch (\Exception $e) {
            logger('Error in UserController.update', [
                $e->getMessage()
            ]);
            return response()->json(
                [
                    'message' => 'Something went wrong updating user ' . $user->id,
                    'errors'  => $e->getMessage()
                ],
                400
            );
        }
    }
}
