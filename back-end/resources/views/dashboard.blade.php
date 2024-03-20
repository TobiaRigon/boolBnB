<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>


    </x-slot>
    @section('content')
        <div class="container mt-4">
            <a class="btn btn-success my-3" href="{{ route('apartment.create') }}">NUOVO APPARTAMENTO</a>
            <h1 class="text-center mb-5">I miei appartamenti: {{ count($apartments) }}</h1>

            <div class="row">
                @foreach ($apartments as $apartment)
                    <div class="col-12 col-md-6 col-lg-4 ">
                        <div class="card my-3">
                            <div class="card-container">
                                <img src="{{ asset($apartment->main_img) }}" class="card-img-top" alt="...">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                                <p class="card-text">{{ Str::limit($apartment->description) }}</p>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('apartments.show', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}"
                                        class="btn btn-primary">APRI</a>
                                    @if (auth()->id() == $apartment->user_id)
                                        <a href="{{ route('apartments.edit', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}"
                                            class="btn btn-secondary">MODIFICA</a>
                                        <form id="delete-form-{{ $apartment->id }}"
                                            action="{{ route('apartment.delete', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $apartment->id }})"
                                                class="btn-delete">ELIMINA</button>
                                        </form>
                                        <div id="confirmation-modal" class="modal">
                                            <div class="modal-content">
                                                <span class="close" onclick="closeModal()">&times;</span>
                                                <p>Sei sicuro di voler eliminare questo appartamento?</p>
                                                <div class="modal-buttons">
                                                    <button onclick="deleteApartment()">Elimina</button>
                                                    <button onclick="closeModal()">Annulla</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>


                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>



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

        <style scoped>
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

            */
        </style>
    @endsection

</x-app-layout>
