 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::post('/dashboard', [MessageController::class, 'store']); 
