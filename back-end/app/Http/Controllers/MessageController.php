<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// IMPORTIAMO IL SUO MODEL
use App\Models\Message;

class MessageController extends Controller
{


    public function index()
    {
        // $user = User ::all();
        $user = Auth::user(); // Recupera l'utente autenticato

        // Recupera gli appartamenti dell'utente con i messaggi associati
        $apartments = $user->apartments()->with('messages')->get();

    //      // Debug output
    // dd($apartments);

        // momentaneamente in pages , poi in Apartment front-end tramite API
        return view('dashboard', compact ('apartments' , 'user' ));
    }

  

    public function store(Request $request) {

        //VALIDAZIONE DATI
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'testo' => 'required|string',
        ]);

        //SALVATAGGIO MESSAGGIO IN DATABASE
        $message = new Message();
        $message->nome =  $validatedData['nome'];
        $message->testo = $validatedData['testo'];

        $message->save();

        //RESTITUISCI UNA RISPOSTA JSON DI SUCCESSO
        return response()->json(['message' => 'Messaggio inviato con successo'], 201);
    }

}
