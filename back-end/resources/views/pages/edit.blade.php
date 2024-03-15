@extends('layouts.app')

@section('content')
    

    <div class="container mt-4">
        <h1 class="text-center mb-5">Edit Apartment</h1>

        @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="container">
           
            <!-- Div che collassa -->
            <div id="newApartmentForm">
                <div class="card card-body mt-3">
                    <!-- Form per l'inserimento di un nuovo appartamento -->
                    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Titolo dell'appartamento -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" value="{{$apartment->title}}" class="form-control" id="title" name="title" required>
                        </div>
                        <!-- Descrizione dell'appartamento -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input value="{{$apartment->description}}" class="form-control" id="description" name="description" required></input>
                        </div>
                        <!-- Max ospiti -->
                        <div class="mb-3">
                            <label for="max_guests" class="form-label">Max Guests</label>
                            <input value="{{$apartment->max_guests}}" type="number" class="form-control" id="max_guests" name="max_guests" required>
                        </div>
                        <!-- Numero di stanze -->
                        <div class="mb-3">
                            <label for="rooms" class="form-label">Rooms</label>
                            <input value="{{$apartment->rooms}}" type="number" class="form-control" id="rooms" name="rooms" required>
                        </div>
                        <!-- Numero di letti -->
                        <div class="mb-3">
                            <label for="beds" class="form-label">Beds</label>
                            <input value="{{$apartment->beds}}" type="number" class="form-control" id="beds" name="beds" required>
                        </div>
                        <!-- Numero di bagni -->
                        <div class="mb-3">
                            <label for="baths" class="form-label">Baths</label>
                            <input value="{{$apartment->baths}}" type="number" class="form-control" id="baths" name="baths" required>
                        </div>
                        <!-- Immagine principale dell'appartamento -->
                        <div class="mb-3">
                            <label for="main_img" class="form-label">
                                <img src="{{$apartment->main_img}}" alt="">
                            </label>
                            <input value="{{$apartment->main_img}}" type="file" class="form-control" id="main_img" name="main_img" required>
                        </div>
                        <!-- Indirizzo dell'appartamento -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input value="{{$apartment->address}}" type="text" class="form-control" id="address" name="address" required>
                        </div>
                        Longitudine e latitudine per la mappa
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input value="{{$apartment->longitude}}" type="text" class="form-control" id="longitude" name="longitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input value="{{$apartment->latitude}}" type="text" class="form-control" id="latitude" name="latitude" required>
                        </div> 
                         Bottone per inviare il form
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
@endsection 