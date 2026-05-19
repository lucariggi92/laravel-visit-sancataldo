<?php

namespace App\Http\Controllers\Api;

use App\Models\Itinerary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index(){

    $itineraries = Itinerary::with('contents.category')->get();

    return response()->json(
        [
            "success"=> true,
            "data"=> $itineraries
        ]
    );
    }
}
