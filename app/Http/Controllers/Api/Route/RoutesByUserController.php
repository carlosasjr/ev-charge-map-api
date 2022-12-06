<?php

namespace App\Http\Controllers\Api\Route;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Models\User;
use Illuminate\Http\Request;

class RoutesByUserController extends Controller
{
    public function __invoke(User $user)
    {
        try {
            $user = $user->with(['routes' => fn ($query) => $query->orderBy('created_at', 'desc')])
            ->findOrFail(auth()->user()->id);

            return RouteResource::collection($user->routes);
        } catch (\Exception $e) {
            logger('Error in RoutesByUserController', [
               $e->getMessage()
            ]);
            return response()->json(
                [
                    'message' => 'Something went wrong getting routes by user id!',
                    'errors'  => $e->getMessage()
                ],
                400);
        }

    }
}
