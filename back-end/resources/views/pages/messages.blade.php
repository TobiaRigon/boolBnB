<x-app-layout>

    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messaggi per l'appartamento: {{ $apartment->title }}
        </h2>
        <div class="row">
            <div class="col-12">
                <p>Ci sono: {{ count($messages) }} messaggi</p>
            </div>
    </x-slot>
    @section('content')
        <div class="container mt-4">

            <div class="row">
                <div class="col-12">
                    <ul>
                        @foreach ($messages as $message)
                            <li class="message-preview">
                                <a href="{{ route('message.show', $message->id) }}">
                                    <p><strong>Da:</strong> {{ $message->sender_name }} {{ $message->sender_surname }}</p>
                                    <p><strong>Email:</strong> {{ $message->sender_mail }}</p>
                                    <p><strong>Data:</strong> {{ $message->date->format('Y-m-d H:i:s') }}</p>
                                    <p><strong>Messaggio:</strong> {{ Str::limit($message->sender_text, 50) }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <style>
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
