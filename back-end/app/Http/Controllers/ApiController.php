<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// IMPORTO I MODEL CHE MI SERVE
use App\Models\Apartment;

class ApiController extends Controller
{

    public function getInEvidenceApartments()
    {
        $apartments = Apartment::where('in_evidence', 1)->get();
        return response()->json($apartments);
    }
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
    public function search(Request $request)
    {
        // Ottieni il parametro di ricerca dalla query string e rimuovi eventuali spazi bianchi extra
        $searchTerm = trim($request->query('search'));

        // Esegui la query degli appartamenti basata sul termine di ricerca
        $apartments = Apartment::where('title', 'like', '%' . $searchTerm . '%')
                               ->orWhere('description', 'like', '%' . $searchTerm . '%')
                               ->orWhere('address', 'like', '%' . $searchTerm . '%')
                               ->get();

        // Restituisci i risultati della query come risposta JSON
        return response()->json($apartments);
    }


}
