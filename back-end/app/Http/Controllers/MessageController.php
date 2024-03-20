<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// IMPORTIAMO IL SUO MODEL
use App\Models\Message;
use App\Models\Apartment;

class MessageController extends Controller
{

    
    // //METODO PER VISUALIZZARE IL FORM PER CREATE UN NUOVO MESSAGGIO 
    // public function create() {

        

    //     return view('create_message');
    // }

    public function store(Request $request) {

        //VALIDAZIONE DATI
        $validatedData = $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email',
            'object' => 'required|string|max:255',
            'sender_text' => 'required|string',
        ]);

        // CREAZIONE SALVATAGGIO MESSAGGIO IN DATABASE
        $message = new Message();

        $message->sender_name = $validatedData['nome'];
        $message->sender_email = $validatedData['email'];
        $message->object = $validatedData['object'];
        $message->sender_text = $validatedData['testo'];
        $message->apartment_id = $validatedData['apartment_id'];
        

        $message->save();

        //RESTITUISCI UNA RISPOSTA JSON DI SUCCESSO
        return response()->json(['message' => 'Messaggio inviato con successo'], 201);
    }

}
