<?php

use App\Http\Controllers\Api\ItineraryController;
use App\Http\Controllers\Api\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get("itineraries",[ItineraryController::class, "index"]);
Route::post("itineraries", [ItineraryController::class, "store"]);
Route::get('/contents/{content}', [ContentController::class, 'show']);