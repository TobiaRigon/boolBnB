<x-app-layout>

    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messaggi per l'appartamento: {{ $apartment->title }}
        </h2>
        <span class="text-sm text-gray-500">({{ count($messages) }} messaggi)</span>
    </x-slot>
    @section('content')
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
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Dettagli
                                                Messaggio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Da:</strong> {{ $message->sender_name }}
                                                {{ $message->sender_surname }}</p>
                                            <p><strong>Email:</strong> {{ $message->sender_mail }}</p>
                                            <p><strong>Data:</strong> {{ $message->date->format('D-m-y H:i') }}</p>
                                            <p><strong>Messaggio:</strong> {{ $message->sender_text }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn my_btn" data-dismiss="modal">CHIUDI</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                // Chiudi il modale quando viene nascosto
                $('.modal').on('hidden.bs.modal', function() {
                    $(this).find('form')[0].reset();
                });
            });
        </script>


        <style scoped>
            .card:hover {
                border: 1px solid #63beec;
            }

            .message-preview {
                background-color: #f8f9fa;
                border: 1px solid #dee2e6;
                border-radius: 5px;
                padding: 10px;
                margin-bottom: 10px;
                transition: background-color 0.3s ease;
            }

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
                /* Cambia colore al passaggio del mouse */
            }

            .message-preview p {
                margin: 5px 0;
            }
        </style>
    @endsection
</x-app-layout>
