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

// Redirect dalla homepage al tuo frontend Vue.js
Route::redirect('/', 'http://localhost:5173/#/', 301);

// Dashboard accessibile solo agli utenti autenticati e verificati
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Visualizzazione pubblica degli appartamenti
Route::get('/dashboard', [ApartmentController::class, 'index'])->name('dashboard');

// Visualizzazione dettagliata di un singolo appartamento
Route::get('/apartment/{id}/{title}', [ApartmentController::class, 'show'])->name('apartments.show');

// Redirect dettagliata di un singolo appartamento in vue.js
Route::redirect('/apartment/{id}/{title}', 'http://localhost:5173/#/apartments/{id}', 301);


// Gruppo di rotte che richiedono autenticazione
Route::middleware('auth')->group(function () {
    // Gestione del profilo utente
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Creazione di un nuovo appartamento
    Route::get('/create', [ApartmentController::class, 'create'])->name('apartment.create');
    Route::post('/create', [ApartmentController::class, 'store'])->name('apartment.store');
    // Cancellazione di un appartamento
    Route::delete('/{id}/{title}', [ApartmentController::class, 'destroy'])->name('apartment.delete'); // Ho cambiato delete in destroy per seguire le convenzioni di Laravel

    // Modifica di un appartamento esistente
    Route::get('/apartment/edit/{id}/{title}', [ApartmentController::class, 'edit'])->name('apartments.edit');
    Route::put('/apartment/edit/{id}/{title}', [ApartmentController::class, 'update'])->name('apartments.update');
});

require __DIR__.'/auth.php';
