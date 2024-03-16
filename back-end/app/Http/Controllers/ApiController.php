<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// IMPORTO I MODEL CHE MI SERVE
use App\Models\Apartment;


class ApiController extends Controller
{


    public function getApartments() {

        $apartments = Apartment::all(); // Voglio tutti gli appartamenti 
        return response()->json($apartments); // Mi restituisce tutti gli appartamenti in formato json
    }


    // GESTIONE ERRORI IN DEBUG
    public function getApartmentById($id) {
        // Cerca l'appartamento nel database
        $apartment = Apartment::find($id);
    
        // Verifica se l'appartamento è stato trovato
        if (!$apartment) {
            // Se l'appartamento non è stato trovato, restituisci un messaggio di errore
            return response()->json(['error' => 'Appartamento non trovato'], 404);
        }
    
        // Restituisci i dettagli dell'appartamento
        return response()->json($apartment);
    }
}
