<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', 'http://localhost:5173/#/', 301);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/apartments', [ApartmentController:: class , 'index'])
-> name('apartments.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ROTTA PER IL METODO CREATE/STORE
    Route::get('/create', [ApartmentController:: class , 'create'])
    -> name('apartment.create');
    Route::post('/create', [ApartmentController:: class , 'store'])
    -> name('apartment.store');

    Route::delete('/{id}', [ApartmentController::class, 'delete'])
    ->name('apartment.delete');

    Route::get('/apartment/edit/{id}', [ ApartmentController:: class, 'edit' ])
-> name ('apartments.edit');

    Route::put('/apartment/edit/{id}', [ ApartmentController:: class, 'update' ])
    -> name ('apartments.update');

});

Route::get('/apartment/{id}', [ ApartmentController:: class, 'show' ])
-> name ('apartments.show');

require __DIR__.'/auth.php';
