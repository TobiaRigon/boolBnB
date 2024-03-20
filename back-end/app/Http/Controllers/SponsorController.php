<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Sponsor;
use App\Models\User;
use Carbon\Carbon;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function applySponsor(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'sponsor_id' => 'required|exists:sponsors,id',
        ]);

        $sponsor = Sponsor::findOrFail($request->sponsor_id);
        $apartment = Apartment::findOrFail($request->apartment_id);

        // Verifica se c'è già una sponsorizzazione attiva per questo appartamento
        $currentSponsor = $apartment->sponsors()->latest()->first();
        $startDate = $currentSponsor ? $currentSponsor->pivot->deadline : Carbon::now();

        // Determina la durata del nuovo sponsor in base all'id del sponsor selezionato
        switch ($sponsor->id) {
            case 1:
                $duration = 24; // 24 ore
                break;
            case 2:
                $duration = 72; // 72 ore
                break;
            case 3:
                $duration = 144; // 144 ore
                break;
            default:
                $duration = 24; // Durata predefinita, se l'id dello sponsor non corrisponde a nessuna delle opzioni
                break;
        }

        // Calcola la data e l'ora in cui inizia la nuova sponsorizzazione (dopo la fine della sponsorizzazione attuale)
        $expirationDate = Carbon::parse($startDate)->addHours($duration);

        // Salva la data di scadenza nella tabella pivot "apartment_sponsor"
        $apartment->sponsors()->attach($sponsor->id, ['deadline' => $expirationDate]);

        // Imposta il campo "in_evidence" a 1
        $apartment->in_evidence = 1;
        $apartment->save();

        // Dopo la scadenza, reimposta il campo "in_evidence" a 0
        // Puoi utilizzare un sistema di code (ad es. Laravel Queue) per gestire automaticamente l'impostazione del campo "in_evidence" a 0 dopo la scadenza del tempo sponsorizzato

        return redirect()->back()->with('success', 'Sponsorizzazione applicata con successo all\'appartamento.');
    }

    public function index()
    {
        $sponsors = Sponsor::all();
        $userApartments = auth()->user()->apartments;

    // Pass the sponsors data to a view
        return view('pages.sponsors', compact('sponsors', 'userApartments'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
