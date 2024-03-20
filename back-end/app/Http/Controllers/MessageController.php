<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

// IMPORTIAMO IL SUO MODEL
use App\Models\Message;

class MessageController extends Controller
{

    public function show($id)
    {
        $message = Message::findOrFail($id);
    
        return view('pages.message_show', compact('message'));
    }



}
