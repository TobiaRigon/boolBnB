@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-5">Crea Nuovo Appartamento</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
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
                    <form action="{{ route('apartment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Titolo dell'appartamento -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <!-- Descrizione dell'appartamento -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizion <span
                                    class="text-danger">*</span>e</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <!-- Max ospiti -->
                        <div class="mb-3">
                            <label for="max_guests" class="form-label">Numero ospiti <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="max_guests" name="max_guests" required>
                        </div>
                        <!-- Numero di stanze -->
                        <div class="mb-3">
                            <label for="rooms" class="form-label">Numero stanza <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="rooms" name="rooms" required>
                        </div>
                        <!-- Numero di letti -->
                        <div class="mb-3">
                            <label for="beds" class="form-label">Letti <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="beds" name="beds" required>
                        </div>
                        <!-- Numero di bagni -->
                        <div class="mb-3">
                            <label for="baths" class="form-label">Bagni <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="baths" name="baths" required>
                        </div>
                        <!-- Immagine principale dell'appartamento -->
                        <div class="mb-3">
                            <label for="main_img" class="form-label">Immagine di coperina <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="main_img" name="main_img" required>
                        </div>
                        <!-- Indirizzo dell'appartamento -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        Longitudine e latitudine per la mappa
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="longitude" name="longitude" required>
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="latitude" name="latitude" required>
                        </div>



                        {{-- Bottone per inviare il form --}}
                        <input type="submit" class="btn btn-success" value="Crea Appartamento">
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
