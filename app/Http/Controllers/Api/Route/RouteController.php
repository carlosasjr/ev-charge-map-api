<?php

namespace App\Http\Controllers\Api\Route;

use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RouteRequest;
use App\Http\Resources\RouteResource;

class RouteController extends Controller
{
    public function __construct(private Route $route)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        try {
            $route = $this->route->create($request->validated());

            return new RouteResource($route);
        } catch (\Exception $e) {
            logger('Error in RouteController.store', [
               $e->getMessage()
            ]);
            return response()->json(
                [
                    'message' => 'Something went wrong save the route!',
                    'errors'  => $e->getMessage()
                ],
                400
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $route = $this->route->findOrFail($id);

            $route->delete();

            return response()->json([
                'success' => 'Route deleted succesfully'
            ], 200);

        } catch (\Exception $e) {
            logger('Error in RouteController.destroy', [
                $e->getMessage()
            ]);
            return response()->json(
                [
                    'message' => 'Something went wrong delete the saved route!',
                    'errors'  => $e->getMessage()
                ],
                400
            );
        }
    }
}
