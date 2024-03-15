<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = $request->validate([
            'title' => 'required|string|max:255|min:2',
            'description' => 'required|string',
            'max_guests' => 'required|integer|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'baths' => 'required|integer|min:1',
            'main_img' => 'required|string',
            'address' => 'required|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ], [
            'title.required' => 'Il campo titolo è obbligatorio.',
            'title.string' => 'Il campo titolo deve essere una stringa.',
            'title.max' => 'Il campo titolo non può essere più lungo di :max caratteri.',
            'title.min' => 'Il campo titolo deve contenere almeno :min caratteri.',
            'description.required' => 'Il campo descrizione è obbligatorio.',
            'description.string' => 'Il campo descrizione deve essere una stringa.',
            'max_guests.required' => 'Il campo ospiti massimi è obbligatorio.',
            'max_guests.integer' => 'Il campo ospiti massimi deve essere un numero intero.',
            'max_guests.min' => 'Il campo ospiti massimi deve essere almeno :min.',
            'rooms.required' => 'Il campo camere è obbligatorio.',
            'rooms.integer' => 'Il campo camere deve essere un numero intero.',
            'rooms.min' => 'Il campo camere deve essere almeno :min.',
            'beds.required' => 'Il campo letti è obbligatorio.',
            'beds.integer' => 'Il campo letti deve essere un numero intero.',
            'beds.min' => 'Il campo letti deve essere almeno :min.',
            'baths.required' => 'Il campo bagni è obbligatorio.',
            'baths.integer' => 'Il campo bagni deve essere un numero intero.',
            'baths.min' => 'Il campo bagni deve essere almeno :min.',
            'main_img.required' => 'Il campo immagine principale è obbligatorio.',
            'main_img.string' => 'Il campo immagine principale deve essere una stringa.',
            'address.required' => 'Il campo indirizzo è obbligatorio.',
            'address.string' => 'Il campo indirizzo deve essere una stringa.',
            'longitude.required' => 'Il campo longitudine è obbligatorio.',
            'longitude.numeric' => 'Il campo longitudine deve essere un numero.',
            'latitude.required' => 'Il campo latitudine è obbligatorio.',
            'latitude.numeric' => 'Il campo latitudine deve essere un numero.',
        ]);

        
        $user = Auth::user();

        $apartment = new Apartment();
        

        $apartment->title = $data['title'];
        $apartment->description = $data['description'];
        $apartment->max_guests = $data['max_guests'];
        $apartment->rooms = $data['rooms'];
        $apartment->beds = $data['beds'];
        $apartment->baths = $data['baths'];
        $apartment->main_img = $data['main_img'];
        $apartment->address = $data['address'];
        $apartment->longitude = $data['longitude'];
        $apartment->latitude = $data['latitude'];
        


        // $service = Service::find($id);
        // $service->apartment()->save($apartment);
        

        // $apartment->services()->attach($data['service_id']);
        // $user_id = User::find($id);
        $user->apartments()->save($apartment);

        // $apartment-> user() -> associate($user);
       
        
        return redirect()->route('apartments.index' , $apartment->id);
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
        $user = Auth::user(); // Recupera l'utente autenticato
        $apartment = Apartment::find($id);
    
        return view('pages.edit', compact('apartment', 'user'));
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
        // $data = $request->all();

        $data = $request->validate([
            'title' => 'required|string|max:255|min:2',
            'description' => 'required|string',
            'max_guests' => 'required|integer|min:1',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'baths' => 'required|integer|min:1',
            'main_img' => '',
            'address' => 'required|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ], [
            'title.required' => 'Il campo titolo è obbligatorio.',
            'title.string' => 'Il campo titolo deve essere una stringa.',
            'title.max' => 'Il campo titolo non può essere più lungo di :max caratteri.',
            'title.min' => 'Il campo titolo deve contenere almeno :min caratteri.',
            'description.required' => 'Il campo descrizione è obbligatorio.',
            'description.string' => 'Il campo descrizione deve essere una stringa.',
            'max_guests.required' => 'Il campo ospiti massimi è obbligatorio.',
            'max_guests.integer' => 'Il campo ospiti massimi deve essere un numero intero.',
            'max_guests.min' => 'Il campo ospiti massimi deve essere almeno :min.',
            'rooms.required' => 'Il campo camere è obbligatorio.',
            'rooms.integer' => 'Il campo camere deve essere un numero intero.',
            'rooms.min' => 'Il campo camere deve essere almeno :min.',
            'beds.required' => 'Il campo letti è obbligatorio.',
            'beds.integer' => 'Il campo letti deve essere un numero intero.',
            'beds.min' => 'Il campo letti deve essere almeno :min.',
            'baths.required' => 'Il campo bagni è obbligatorio.',
            'baths.integer' => 'Il campo bagni deve essere un numero intero.',
            'baths.min' => 'Il campo bagni deve essere almeno :min.',
            'main_img.string' => 'Il campo immagine principale deve essere una stringa.',
            'address.required' => 'Il campo indirizzo è obbligatorio.',
            'address.string' => 'Il campo indirizzo deve essere una stringa.',
            'longitude.required' => 'Il campo longitudine è obbligatorio.',
            'longitude.numeric' => 'Il campo longitudine deve essere un numero.',
            'latitude.required' => 'Il campo latitudine è obbligatorio.',
            'latitude.numeric' => 'Il campo latitudine deve essere un numero.',
        ]);


        $apartment = Apartment::find($id);

        $user = Auth::user();
        
        $apartment->title = $data['title'];
        $apartment->description = $data['description'];
        $apartment->max_guests = $data['max_guests'];
        $apartment->rooms = $data['rooms'];
        $apartment->beds = $data['beds'];
        $apartment->baths = $data['baths'];
        $apartment->main_img = $data['main_img'];
        $apartment->address = $data['address'];
        $apartment->longitude = $data['longitude'];
        $apartment->latitude = $data['latitude'];
        


        // $service = Service::find($id);
        // $service->apartment()->save($apartment);
        

        // $apartment->services()->attach($data['service_id']);
        // $user_id = User::find($id);
        $user->apartments()->save($apartment);

        // $apartment-> user() -> associate($user);
       
        
        return redirect()->route('apartments.show' , $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $apartment = Apartment::find($id);

        $apartment->services()->detach();
        $apartment->sponsors()->detach();
        
        $apartment->delete();

        return redirect()->route('apartments.index');
    }
}
