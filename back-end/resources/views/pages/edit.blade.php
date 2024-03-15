@extends('layouts.app')

@section('content')
    

    <div class="container mt-4">
        <h1 class="text-center mb-5">Edit Apartment</h1>

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
                        <!-- <div class="mb-3">
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
                        <button type="submit" class="btn btn-success">Submit</button> -->
                        {{-- address  --}}
                                    <div class="mb-3 position-relative">
                                        <label for="address"
                                            class="form-label  @error('address') text-danger @enderror ">Indirizzo
                                            completo <span class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address"
                                            placeholder="Esempio Via Mario Rossi, 74, Milano (MI), Italia" maxlength="255"
                                            value="{{ old('address', $apartment->address) }}" autocomplete="off">
                                        @error('address')
                                            <p class="text-danger fw-bold">{{ $message }}</p>
                                        @enderror
                                        <div id="menuAutoComplete" class="card position-absolute w-100 radius d-none">
                                            <ul class="list">

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
@endsection 


@section('javascript')

    <script>

const search = document.getElementById('address');
const menuAutoComplete = document.getElementById('menuAutoComplete');
const ulList = document.querySelector('ul.list');
const apiKey = '3kxy0pDsUIXUoGVxfKBKIXXHksHtr1a8';

search.addEventListener('input', function() {
    if (search.value.trim() !== '') {
        getTomTomSuggestions(search.value.trim());
    } else {
        ulList.innerHTML = '';
    }
});

function getTomTomSuggestions(address) {
   fetch(`https://api.tomtom.com/search/2/search/${encodeURIComponent(address)}.json?key=${apiKey}`)
        .then(response => response.json())
        .then(data => {
            ulList.innerHTML = ''; // Clear previous results
            if (data.results && data.results.length > 0) {
                data.results.forEach(result => {
                    const li = document.createElement('li');
                    li.textContent = result.address.freeformAddress;
                    li.addEventListener('click', function() {
                        search.value = result.address.freeformAddress;
                        ulList.innerHTML = ''; // Clear results on selection
                    });
                    ulList.appendChild(li);
                });
                menuAutoComplete.classList.remove('d-none'); // Show results
            } else {
                menuAutoComplete.classList.add('d-none'); // Hide results if no suggestions
            }
        })
        .catch(error => {
            console.error('Error fetching TomTom suggestions:', error);
        });
}

        
    </script>

@endsection