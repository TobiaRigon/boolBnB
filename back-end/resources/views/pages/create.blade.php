@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="h2 text-center mb-5">Crea Nuovo Appartamento</h1>

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
                    <form action="{{ route('apartment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="h5 form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="h5 form-label">Descrizione <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="max_guests" class="h5 form-label">Numero ospiti <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="max_guests" name="max_guests"
                                value="{{ old('max_guests') }}" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="rooms" class="h5 form-label">Numero stanza <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="rooms" name="rooms"
                                value="{{ old('rooms') }}" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="beds" class="h5 form-label">Letti <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="beds" name="beds"
                                value="{{ old('beds') }}" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="baths" class="h5 form-label">Bagni <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="baths" name="baths"
                                value="{{ old('baths') }}" required min="1">
                        </div>

                        <div class="mb-3">
                            <span class="h5">Seleziona i servizi:</span>
                            <div class="row w-100  mb-3">
                            @foreach ($services as $service)
                                <div class="col-4 py-3">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                        @if (is_array(old('services')) && in_array($service->id, old('services'))) checked @endif>
                                    <label>{{ $service->name }}</label>
                                </div>
                            @endforeach
                            </div>
                         
                        </div>

                        <div class="mb-3">
                            <label for="main_img" class="form-label">Immagine di copertina <span
                                    class="text-danger">*</span>
                                </label><br>
                            <input class="my-3"  type="file" name="main_img">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo dell'appartamento</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address') }}">
                        </div>

                        <div id="AutoComplete" class="card position-absolute w-100 radius d-none">
                            <ul class="list" style="cursor: pointer;">
                            </ul>
                        </div>

                        <div class="d-none">
                            <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}">
                            <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}">
                        </div>

                        <button type="submit" class="btn my_btn">Crea</button>
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


    <style>
        #AutoComplete ul li:hover {
            background-color: rgba(0, 0, 255, 0.1);
            border: 1px solid darkgrey;
        }

        .btn-submit {
            background-color: white;
            color: green;
            padding: 8px;
            border-radius: 4px;
            transition-duration: 0.4s;
        }

        .btn-submit:hover {
            background-color: green;
            color: white;
        }
    </style>

@endsection
