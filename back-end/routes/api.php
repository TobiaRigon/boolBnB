<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apartments/in-evidence', 'App\Http\Controllers\ApiController@getInEvidenceApartments');

Route::group(['prefix' => '/apartmentApi'] , function(){
    Route::get('/apartments', [ApiController::class, 'getApartments']);
    Route::get('/apartments/{id}', [ApiController::class, 'getApartmentById']);
       //Rotta per la ricerca degli appartamenti
    // Route::get('/apartments/search', [ApiController ::class, 'search']);
    Route::get('search', [ApiController ::class, 'search']);

    // Rotta post messages
    Route::post('messages', [ApiController ::class, 'sendMessage']);

    // Rotta per gestire il filtro 
    Route::get('filter', [ApiController::class, 'filter']);
    Route::get('services',[ApiController::class, 'getServices']);
});



