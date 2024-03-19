@extends('layouts.app')

@section('content')


    <div class="container mt-4">
        <h1 class="text-center mb-5">Modifica appartamento</h1>

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
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" value="{{$apartment->title}}" class="form-control" id="title" name="title" required>
                        </div>
                        <!-- Descrizione dell'appartamento -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <input value="{{$apartment->description}}" class="form-control" id="description" name="description" required></input>
                        </div>
                        <!-- Max ospiti -->
                        <div class="mb-3">
                            <label for="max_guests" class="form-label">Numero ospiti</label>
                            <input value="{{$apartment->max_guests}}" type="number" class="form-control" id="max_guests" name="max_guests" min="1" required>
                        </div>
                        <!-- Numero di stanze -->
                        <div class="mb-3">
                            <label for="rooms" class="form-label">Numero stanze</label>
                            <input value="{{$apartment->rooms}}" type="number" class="form-control" id="rooms" name="rooms" min="1" required>
                        </div>
                        <!-- Numero di letti -->
                        <div class="mb-3">
                            <label for="beds" class="form-label">Numero letti</label>
                            <input value="{{$apartment->beds}}" type="number" class="form-control" id="beds" name="beds" min="1" required>
                        </div>
                        <!-- Numero di bagni -->
                        <div class="mb-3">
                            <label for="baths" class="form-label">Numero bagni</label>
                            <input value="{{$apartment->baths}}" type="number" class="form-control" id="baths" name="baths" min="1" required>
                        </div>
                        <!-- Immagine principale dell'appartamento -->
                        <div class="mb-3">
                            <label for="main_img" class="form-label">
                                <img src="{{$apartment->main_img}}" alt="">
                            </label>
                            <input value="{{$apartment->main_img}}" type="file" class="form-control" id="main_img" name="main_img" >
                        </div>

                        {{-- servizi --}}
                        <div class="mb-3">
                            @foreach($services as $service)
                                <div>
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}" {{ in_array($service->id, $currentServices) ? 'checked' : '' }}>
                                    <label>{{ $service->name }}</label>
                                </div>
                            @endforeach
                        </div>


                        {{-- address  --}}

                                    <div class="mb-3">
                            <!-- scegli città -->

                            <label for="address" class="form-label"> Indirizzo dell'appartamento</label>
                        
                            </div>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $apartment->address) }}" required>
                        </div>
                         <div id="AutoComplete" class="card position-absolute w-100 radius d-none">
                            <ul class="list" style="cursor: pointer;">
                            </ul>
                        </div>
                    </div>
                    <div class="d-none">
                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $apartment->latitude) }}" required>
                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $apartment->longitude) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Modifica</button>
                    </form>
                </div>
            </div>
        </div>


    </div>


<script>


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

</style>

@endsection
