<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// IMPORTO I MODEL CHE MI SERVE
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;

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

    public function filter(Request $request)
{
    // Esegui la logica di filtraggio utilizzando i dati forniti dalla richiesta
    $letti = $request->input('letti');
    $stanze = $request->input('stanze');
    $servizi = $request->input('servizi');

    // Esegui la query per filtrare gli appartamenti
    $query = Apartment::query();

    // Applica i filtri se sono presenti
    if (!empty($letti)) {
        $query->where('beds', '>=', $letti);
    }
    
    if (!empty($stanze)) {
        $query->where('rooms', '>=', $stanze);
    }

    // Applica i filtri per i servizi
    if (!empty($servizi)) {
        $query->whereHas('services', function ($q) use ($servizi) {
            $q->whereIn('id', $servizi);
        });
    }

    // Esegui la query e ottieni gli appartamenti filtrati
    $filteredApartments = $query->get();
    
    // Restituisci in JSON i risultati del filtraggio
    return response()->json($filteredApartments);
}


    public function getServices()
    {
        $services = Service::all();
      
        return response()->json($services);
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
