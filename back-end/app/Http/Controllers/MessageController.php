<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// IMPORTIAMO IL SUO MODEL
use App\Models\Message;

class MessageController extends Controller
{
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
