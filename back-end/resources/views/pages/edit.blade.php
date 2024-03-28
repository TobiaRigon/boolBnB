@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="h2 text-center mb-5">Modifica appartamento</h1>

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
            <div id="newApartmentForm">
                <div class="card card-body mt-3">
                    <form
                        action="{{ route('apartments.show', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="h5" for="title" class="form-label">Titolo</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $apartment->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="h5 py-3" for="address" class="form-label">Indirizzo dell'appartamento</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $apartment->address) }}" required>
                        </div>

                        <div class="mb-3 ">
                            <label  for="main_img" class="h5 form-label">Immagine principale dell'appartamento</label>
                            <br>
                            <input type="file" class=" " id="main_img" name="main_img">
                            <!-- <div class=" text-center">
                            <img class="mt-3" src="{{ $apartment->main_img }}" alt=""
                                style="max-width: 300px; max-height: 200px;">
                            </div> -->
                           
                        </div>

                        <div class="mb-3">
                            <label class="h5" for="description" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="description" name="description" required>{{ old('description', $apartment->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="h5" for="max_guests" class="form-label">Numero ospiti</label>
                            <input type="number" class="form-control" id="max_guests" name="max_guests"
                                value="{{ old('max_guests', $apartment->max_guests) }}" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="h5" for="rooms" class="form-label">Numero stanze</label>
                            <input type="number" class="form-control" id="rooms" name="rooms"
                                value="{{ old('rooms', $apartment->rooms) }}" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="h5" for="beds" class="form-label">Numero letti</label>
                            <input type="number" class="form-control" id="beds" name="beds"
                                value="{{ old('beds', $apartment->beds) }}" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label class="h5" for="baths" class="form-label">Numero bagni</label>
                            <input type="number" class="form-control" id="baths" name="baths"
                                value="{{ old('baths', $apartment->baths) }}" min="1" required>
                        </div>

                       

                        <span class="h5">Seleziona i servizi:</span>
                        <div class="row w-100  mb-3" >
                           
                            @foreach ($services as $service)
                                <div class="col-4 py-3">
                                    <input  type="checkbox" name="services[]" value="{{ $service->id }}"
                                        {{ in_array($service->id, old('services', $currentServices)) ? 'checked' : '' }}>
                                    <label>{{ $service->name }}</label>
                                </div>
                            @endforeach
                        </div>

                       

                        <div class="d-none">
                            <input type="text" id="latitude" name="latitude"
                                value="{{ old('latitude', $apartment->latitude) }}" required>
                            <input type="text" id="longitude" name="longitude"
                                value="{{ old('longitude', $apartment->longitude) }}" required>
                        </div>

                        <button type="submit" class="my-2 btn my_btn">Modifica</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        //scegli città
        //scrivo una funzione che, in base al click mi da diversi valori di lat, long e radius

        let lat = '';
        let lon = '';
        let radius = '';


        // chiave API
        const keyApi = 'brzK3He1s61mi6MQycw8qJXnuSAtFOfx';


        // Elementi nel DOM
        const searchEl = document.getElementById('address');
        const AutoCompleteEl = document.getElementById('AutoComplete');
        const AutoCompleteClass = AutoCompleteEl.classList;
        const ulListEl = AutoCompleteEl.querySelector('ul.list');
        //latitudine e longitudine
        const latitude = document.getElementById('latitude');
        const longitude = document.getElementById('longitude');


        searchEl.addEventListener('input', function() {
            if (searchEl.value != '')
                searchAdress(searchEl.value);
            addRemoveClass();

        })


        function searchAdress(adress) {
            fetch(
                    `https://api.tomtom.com/search/2/search/${adress}.json?key=${keyApi}`
                )
                .then(response => response.json())
                .then(data => {

                    console.log(data.results);


                    ulListEl.innerHTML = '';
                    if (data.results != undefined)
                        data.results.forEach(function(currentValue, index, array) {

                            const li = document.createElement('li');
                            li.append(currentValue.address.freeformAddress);
                            li.addEventListener('click',
                                () => {
                                    searchEl.value = currentValue.address.freeformAddress;
                                    AutoCompleteClass.add('d-none');
                                    ulListEl.innerHTML = '';
                                    latitude.value = currentValue.position.lat;
                                    longitude.value = currentValue.position.lon;
                                    console.log(latitude.value, 'lat');
                                    console.log(longitude.value, 'lon');
                                    console.log(latitude.value);
                                }
                            )

                            // fine
                            ulListEl.appendChild(li);
                        });
                });
        }


        document.addEventListener('click', function(event) {
            // Verifica se il clic è avvenuto all'interno del menu
            const isClickInsideMenu = AutoCompleteEl.contains(event.target);

            // Se il clic non è avvenuto all'interno del menu, chiudi il menu
            if (!isClickInsideMenu) {
                AutoCompleteClass.add('d-none');
            }
        });

        // funzione per gestire classi
        function addRemoveClass() {
            console.log(AutoCompleteClass);
            if (searchEl.value == '')
                AutoCompleteClass.add('d-none');
            else
                AutoCompleteClass.remove('d-none');
        }
    </script>

    <style scoped>
        #AutoComplete ul li:hover {
            background-color: rgba(0, 0, 255, 0.1);
            border: 1px solid darkgrey;
        }
    </style>

@endsection
