<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

// importa modelli collegati
use App\Models\Apartment;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\User;
use App\Models\View;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User ::all();

        $apartments = Apartment :: all();

        // momentaneamente in pages , poi in Apartment front-end tramite API
        return view('pages.apartments', compact ('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user(); // Recupera l'utente autenticato
        $apartments = Apartment::all();

        return view('pages.create', compact('apartments', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


public function store(Request $request)
{
    // Validazione dei dati inviati dall'utente escluso latitudine e longitudine
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'max_guests' => 'required|integer|min:1',
        'rooms' => 'required|integer|min:1',
        'beds' => 'required|integer|min:1',
        'baths' => 'required|integer|min:1',
        'address' => 'required|string|max:255',
        'main_img' => 'nullable|image|max:1999',
    ]);

    // Chiamata API a TomTom per ottenere latitudine e longitudine dall'indirizzo
    // $apiKey = 'TUA_CHIAVE_API_TOMTOM';
    // $response = Http::get("https://api.tomtom.com/search/2/geocode/{$data['address']}.json?key={$apiKey}");

    // if($response->successful()) {
    //     $location = $response->json()['results'][0]['position'];
    //     $latitude = $location['lat'];
    //     $longitude = $location['lon'];
    // } else {
    //     // Gestisci l'errore o imposta valori di default
    //     $latitude = 0;
    //     $longitude = 0;
    // }

    // Gestione del caricamento dell'immagine
    if ($request->hasFile('main_img')) {
        $file = $request->file('main_img');
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $file->storeAs('public/apartments', $fileNameToStore);
    } else {
        $fileNameToStore = 'noimage.jpg';
    }

    // Creazione e salvataggio dell'appartamento nel database
    $apartment = new Apartment();
    $apartment->user_id = Auth::id(); // Associa l'appartamento all'utente autenticato
    $apartment->title = $data['title'];
    $apartment->description = $data['description'];
    $apartment->max_guests = $data['max_guests'];
    $apartment->rooms = $data['rooms'];
    $apartment->beds = $data['beds'];
    $apartment->baths = $data['baths'];
    $apartment->address = $data['address'];
    $apartment->latitude = $latitude;
    $apartment->longitude = $longitude;
    $apartment->main_img = $fileNameToStore;
    $apartment->save();

    // Reindirizzamento alla pagina degli appartamenti con un messaggio di successo
    return redirect()->route('apartments.index')->with('success', 'Appartamento creato con successo!');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $apartment = Apartment :: find($id);
        return view('pages.show', compact('apartment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);

        // Controllo se l'utente attualmente autenticato è il proprietario dell'appartamento
        if (auth()->id() !== $apartment->user_id) {
            return redirect()->back()->with('error', 'Non sei autorizzato a eliminare questo appartamento.');
        }


        return view('apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);

        if (auth()->id() !== $apartment->user_id) {
            abort(403);
        }

        // Aggiorna l'appartamento
        $apartment->update($request->all());

        return redirect()->route('apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);

        if (auth()->id() !== $apartment->user_id) {
            return redirect()->back()->with('error', 'Non sei autorizzato a eliminare questo appartamento.');
        }


        $apartment->delete();

        return redirect()->route('apartments.index');
    }

}
