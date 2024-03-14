<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        $apartments = Apartment::all();
        
        return view('pages.create',compact('apartments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        $apartment = new Apartment();
        $apartment->title = $data['tile'];
        $event->description = $data['description'];
        $event->max_guests = $data['max_guests'];
        $event->rooms = $data['rooms'];
        $event->beds = $data['beds'];
        $event->baths = $data['baths'];
        $event->main_img = $data['main_img'];
        $event->address = $data['address'];
        $event->longitude = $data['longitude'];
        $event->latitude = $data['latitude'];
        


        $service = Service::find($id);
        $service->apartment()->save($apartment);
        

        $apartment->services()->attach($data['service_id']);

        
        return redirect()->route('apartments.index');
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
    public function delete($id)
    {
        $apartment = Apartment::find($id);

        $apartment->services()->detach();
        $apartment->sponsors()->detach();
        
        $apartment->delete();

        return redirect()->route('apartments.index');
    }
}
