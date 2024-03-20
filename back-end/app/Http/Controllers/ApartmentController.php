<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
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
        $user = Auth::user(); // Recupera l'utente autenticato
        $apartments = $user->apartments;// Recupera gli appartamenti dell'utente

        // momentaneamente in pages , poi in Apartment front-end tramite API
        return view('dashboard', compact ('apartments' , 'user' ));
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
        $services = Service::all();

        return view('pages.create', compact('apartments', 'services','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request, $title)
    {
        $data = $request->all();
        $user = Auth::user();

        // ... Logica API TomTom qui

        // Assumendo che StoreApartmentRequest validi tutti i campi necessari
        // $apartment->latitude = $latitude; // Se stai utilizzando i campi latitudine e longitudine
        // $apartment->longitude = $longitude;

        $path = 'noimage.jpg'; // Imposta un'immagine predefinita

        if ($request->hasFile('main_img')) {
            $filenameWithExt = $request->file('main_img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('main_img')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('main_img')->storeAs('public/apartments', $fileNameToStore);

            // Modifica il percorso per rimuovere "public/" e aggiungere "storage/"
            $path = str_replace('public/', 'storage/', $path);
        }


        $apartment = new Apartment([
            'title' => $request->title,
            'description' => $request->description,
            'max_guests' => $request->max_guests,
            'rooms' => $request->rooms,
            'beds' => $request->beds,
            'baths' => $request->baths,
            'main_img' => $path, // Assumi che "image" sia il nome della colonna nel tuo database
            'address' => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            // Assicurati di includere qui eventuali altri campi richiesti
        ]);
        $apartment->user_id = auth()->id();


        $apartment->save();
        if ($request->has('services')) {
            $apartment->services()->sync($request->services, false); // Ensure existing associations are retained
        }


        // Gestione dell'upload delle immagini della galleria

        return redirect()->route('dashboard')->with('success', 'Appartamento creato con successo!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $title)
    {

        $apartment = Apartment :: findOrFail($id);
        return view('pages.show', compact('apartment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $title)
    {
        $apartment = Apartment::findOrFail($id);

        // Controllo se l'utente attualmente autenticato è il proprietario dell'appartamento
        if (auth()->id() !== $apartment->user_id) {
            return redirect()->back()->with('error', 'Non sei autorizzato a eliminare questo appartamento.');
        }

        $services = Service::all();

        // Recupera i servizi attualmente associati all'appartamento
        $currentServices = $apartment->services->pluck('id')->toArray();


        return view('pages.edit', compact('apartment', 'services', 'currentServices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, $id, $title)
{
    $apartment = Apartment::findOrFail($id);

    if (auth()->id() !== $apartment->user_id) {
        abort(403);
    }

    // Verifica se è stata caricata una nuova immagine
    if ($request->hasFile('main_img')) {
        // Elimina l'immagine precedente dal filesystem se esiste
        if (Storage::exists($apartment->main_img)) {
            Storage::delete($apartment->main_img);
        }

        // Carica la nuova immagine
        $filenameWithExt = $request->file('main_img')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('main_img')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $request->file('main_img')->storeAs('public/apartments', $fileNameToStore);

        // Modifica il percorso per rimuovere "public/" e aggiungere "storage/"
        $path = str_replace('public/', 'storage/', $path);

        // Aggiorna il percorso dell'immagine nel database
        $apartment->main_img = $path;
    }

    // Aggiorna gli altri campi dell'appartamento
    $apartment->update([
        'title' => $request->title,
        'description' => $request->description,
        'max_guests' => $request->max_guests,
        'rooms' => $request->rooms,
        'beds' => $request->beds,
        'baths' => $request->baths,
        'address' => $request->address,
        'longitude' => $request->longitude,
        'latitude' => $request->latitude,
        // Assicurati di includere qui eventuali altri campi richiesti
    ]);
    if ($request->has('services')) {
        $apartment->services()->sync($request->services);
    } else {
        // Se non vengono selezionati nuovi servizi, disassocia tutti i servizi dall'appartamento
        $apartment->services()->detach();
    }

    return redirect()->route('apartments.show', $apartment->id)->with('success', 'Appartamento aggiornato con successo!');
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

        return redirect()->route('dashboard');
    }



}
