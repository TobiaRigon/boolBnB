<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// IMPORTO I MODEL CHE MI SERVE
use App\Models\Apartment;


class ApiController extends Controller
{


    public function getApartments() {

        $apartments = Apartment::all(); // Voglio tutti gli appartamenti 
        return response()->json($apartments); // Mi restituisce tutti gli appartamenti in formato json
    }



    public function getApartmentById($id) {

        $apartment = Apartment::find($id); // Voglio appartamento con ID che ho fornito 
        return response()->json($apartment); // Mi restituisce appartamento in formato json
    }
}
