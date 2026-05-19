<?php

namespace App\Http\Controllers\Api;

use App\Models\itineraries

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

    $itineraries = itinerary::all();

    return response()->json(
        [
            "success"=> true,
            "data"=> $itineraries
        ]
    );
    }
}
