<x-app-layout>

    <x-slot name="header">
        <h2 class="">
            {{ __('Dashboard') }}
        </h2>



    </x-slot>
    @section('content')

    <div class="container">
        <!-- Bottoni Sponsor + crea -->
    <div class="my-2">
        <a class="btn my-2 my_btn" href="{{ route('apartment.create') }}">NUOVO APPARTAMENTO</a>
        <a class="btn my-2 my_btn" href="{{ route('sponsors.index') }}">SPONSORIZZA I TUOI APPARTAMENTI</a>
    </div>

    <!-- i miei appartamenti -->
   
    <h1 class="text-center my-3 h3">I miei appartamenti: {{ count($apartments) }}</h1>

    <div class="row justify-content-center">

    <!-- Cards -->
        @foreach ($apartments as $apartment)
        <a href="{{ route('apartments.show', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card my_card my-3">
                    <div class="card-container text-center">
                        <!-- immagine card -->
                        <img src="{{ asset($apartment->main_img) }}" class="card-img-top h-80" alt="...">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        <p class="card-text p-2">{{ Str::limit($apartment->description) }}</p>


                        <!-- tasti card -->
                        <div class="container-fluid pb-3">
                            <div class="row">
                                @if (auth()->id() == $apartment->user_id)
                                <div class="col-4">
                                    <a href="{{ route('apartments.edit', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}" class="btn my_btn">MODIFICA</a>
                                </div>
                                <div class="col-4">
                                    <a class="btn my_btn" href="{{ route('pages.messages', $apartment->id) }}">MESSAGGI</a>
                                </div>
                                <div class="col-4">
                                    <form id="delete-form-{{ $apartment->id }}" action="{{ route('apartment.delete', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $apartment->id }})" class="btn btn-danger">ELIMINA</button>
                                    </form>
                                </div>  
                            </div>
                        </div>


                        <!-- conferma elimina messaggio -->
                        <div id="confirmation-modal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <p>Sei sicuro di voler eliminare questo appartamento?</p>
                                <div >
                                    <button class="btn my_btn" onclick="deleteApartment()">Elimina</button>
                                    <button class="btn btn-danger" onclick="closeModal()">Annulla</button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>




   

        <style scoped>
            a:hover{
                color:black;
                text-decoration:none;
            }
            img {
                height: 180px;
                width: 100%;
                object-fit: cover;
            }

            .card {
                height: 500px;
            }

            .card-container {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%;
            }

            .card-text {
                overflow-y: auto;
                height: 5080
            }

            .card-text::-webkit-scrollbar {
                display: none;
                /* Hide scrollbar for Chrome, Safari and Opera */
            }

            .card-text {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }

            .btn-delete {
                background-color: red;
                color: white;
                padding: 7px;
                border-radius: 4px;
            }

            /* Modale */

            .modal {
                display: none;
                /* Nascondi il modal per impostazione predefinita */
                position: fixed;
                /* Posizione fissa rispetto alla finestra del browser */
                z-index: 1;
                /* Posiziona il modal sopra il resto del contenuto */
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                /* Abilita lo scorrimento se il contenuto del modal è troppo lungo */
                background-color: rgba(0, 0, 0, 0.4);
                /* Sfondo scuro leggermente trasparente */
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                /* Posiziona il modal al centro dello schermo */
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                /* Larghezza del modal */
            }

            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }

            .modal-buttons {
                text-align: center;
            }

            .modal-buttons button {
                margin: 0 10px;
                padding: 10px 20px;
                background-color: #ccc;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .modal-buttons button:hover {
                background-color: #ddd;
            }

</style>

<script>
    function confirmDelete(apartmentId) {
        var modal = document.getElementById('confirmation-modal');
        modal.style.display = 'block';
        // Passa l'id dell'appartamento alla funzione deleteApartment
        deleteApartment.apartmentId = apartmentId;
    }

    function deleteApartment() {
        var apartmentId = deleteApartment.apartmentId;
        document.getElementById('delete-form-' + apartmentId).submit();
    }

    function closeModal() {
        var modal = document.getElementById('confirmation-modal');
        modal.style.display = 'none';
    }
</script>


 @endsection

</x-app-layout>
