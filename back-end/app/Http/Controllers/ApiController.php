<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// IMPORTO I MODEL CHE MI SERVE
use App\Models\Apartment;
use App\Models\Message;

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
        $searchTerm = trim($request->query('search'));

        // Ottieni le coordinate di longitudine e latitudine del luogo cercato dall'app
        $userLongitude = $request->input('user_longitude');
        $userLatitude = $request->input('user_latitude');

        // Esegui la query degli appartamenti basata sul termine di ricerca e calcola la distanza
        $apartments = Apartment::selectRaw('*, ST_DISTANCE(POINT(?, ?), POINT(longitude, latitude)) AS distance', [$userLongitude, $userLatitude])
            ->where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->orWhere('address', 'like', '%' . $searchTerm . '%')
            ->orderBy('distance')
            ->get();

        // Restituisci i risultati della query come risposta JSON
        return response()->json($apartments);
    }
    public function sendMessage(Request $request)
    {

        $data = $request ->all();

        $message = new Message;
        $message-> apartment_id = $data['apartment_id'];
        $message-> sender_name = $data['sender_name'];
        $message-> sender_surname = $data['sender_surname'];
        $message-> sender_mail = $data['sender_mail'];
        $message-> date = $data['date'];
        $message-> sender_text = $data['sender_text'];

        $message -> save();


       return response()->json([
        'status'=>'success',
        'message' => $message
       ]);
    }

}
