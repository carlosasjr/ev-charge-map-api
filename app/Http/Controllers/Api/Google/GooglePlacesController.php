<?php

namespace App\Http\Controllers\Api\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SKAgarwal\GoogleApi\PlacesApi;

class GooglePlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $googlePlaces = new PlacesApi(config('google.api'));

            $response = $googlePlaces->placeAutocomplete(
                $request->get('input'), [
                    'components' => 'country:br'
                ]
            );

            return response()->json(['places' => $response]);


        } catch (\Exception $e) {
            logger('Something went wrong this GooglePlacesController.index', [
                $e->getMessage()
            ]);
            return response()->json(
                ['error' => 'Something went wrong getting Google Places data']
            );
        }
    }
}
