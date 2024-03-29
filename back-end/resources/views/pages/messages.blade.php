<x-app-layout>

    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messaggi per l'appartamento: {{ $apartment->title }}
        </h2>
        <span class="text-sm text-gray-500">({{ count($messages) }} messaggi)</span>
    </x-slot>
    @section('content')
    <main>
        <div class="container mt-4">

            <div class="row">
                <div class="col-12">
                    <ul>
                        @foreach ($messages as $message)
                            <!-- All'interno del ciclo foreach dei messaggi -->
                            <a href="#" class="card p-3 my-3" data-toggle="modal"
                                data-target="#messageModal{{ $message->id }}">
                                <p><strong>Da:</strong> {{ $message->sender_name }} {{ $message->sender_surname }}</p>
                                <p><strong>Email:</strong> {{ $message->sender_mail }}</p>
                                <p><strong></strong> {{ $message->date->format('D-m-y H:i') }}</p>
                            </a>

                            <!-- Modale per i dettagli del messaggio -->
                           

                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content rounded-lg shadow-sm bg-light"> <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title d-flex align-items-center">
                            <i class="fas fa-envelope mr-2"></i> Dettagli Messaggio
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                            <div class="col-sm-3 text-center border-right border-light">
                                <!-- <img src="{{ asset('images/avatar.png') }}" class="img-fluid rounded-circle mt-3 mb-2" alt="Avatar"> -->
                                <p class="text-muted">{{ $message->sender_name }} {{ $message->sender_surname }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="font-weight-bold mb-1">Dettagli messaggio:</p>
                                <p><strong>Email:</strong> {{ $message->sender_mail }}</p>
                                <p><strong>Data:</strong> {{ $message->date->format('D-m-y H:i') }}</p>
                                <hr class="my-2">
                                <p class="text-justify">{{ $message->sender_text }}</p> </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-white">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Chiudi</button>
                        </div>
                        </div>
                    </div>
                    </div>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>


        <script>
            $(document).ready(function() {
                // Chiudi il modale quando viene nascosto
                $('.modal').on('hidden.bs.modal', function() {
                    $(this).find('form')[0].reset();
                });
            });
        </script>


        <style scoped>
            main{
                background-color:#1c3a4a;
                border-radius:20px;
                padding:10px;
            }
            .card:hover {
                transform: scale(1.02); /* Aumento del 2% */
                transition: transform 0.2s ease-in-out; /* Transizione di 0.2 secondi */
            }

            .message-preview {
                background-color: #f8f9fa;
                border: 1px solid #dee2e6;
                border-radius: 5px;
                padding: 10px;
                margin-bottom: 10px;
                transition: background-color 0.3s ease;
            }
            /* Stile MODAL */
            
            /* .modal-header{
                background-color:#1c3a4a;
            }
            .modal-footer{
                background-color:#1c3a4a;
            }
            .modal-title{
                color:white;
            }
            .close{
                color:white;
            } */
            a {
                color: black;
                text-decoration: none;
            }

            a:hover {
                color: black;
                text-decoration: none;
            }

            .message-preview:hover {
                background-color: #cce5ff;
                
            }

            .message-preview p {
                margin: 5px 0;
            }

            

        </style>
    @endsection
</x-app-layout>
