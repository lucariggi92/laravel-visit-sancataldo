<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\MoodController;


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/esercizio', function () {
    return view('esercizio');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// applica due middleware a tutte le route del gruppo
Route::middleware(["auth", "verified"])
->name("admin.") //route
->prefix("admin")//url
->group(function(){

  Route::resource("contents", ContentController::class);
 Route::resource("categories", CategoryController::class);
 Route::resource("itineraries", ItineraryController::class);
  Route::resource("moods", MoodController::class);


});

require __DIR__.'/auth.php';

