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

    public function getApartmentById($id) {
        // Cerca l'appartamento nel database e carica anche i servizi associati
        $apartment = Apartment::with('services')->find($id);

        // Verifica se l'appartamento è stato trovato
        if (!$apartment) {
            // Se l'appartamento non è stato trovato, restituisci un messaggio di errore
            return response()->json(['error' => 'Appartamento non trovato'], 404);
        }

        // Restituisci i dettagli dell'appartamento con i servizi associati
        return response()->json($apartment);
    }
}
