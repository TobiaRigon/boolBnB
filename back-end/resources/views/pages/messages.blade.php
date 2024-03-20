<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Messaggi per l'appartamento: {{ $apartment->title }}
        </h2>
    </x-slot>
    @section('content')
    <div class="container mt-4">
        
        <div class="row">
            <div class="col-12">
                <ul>
                    @foreach ($messages as $message)
                    <li class="message-preview">
                     <a href="{{ route('message.show', $message->id) }}">
                            <p><strong>From:</strong> {{ $message->sender_name }} {{ $message->sender_surname }}</p>
                            <p><strong>Email:</strong> {{ $message->sender_mail }}</p>
                            <p><strong>Date:</strong> {{ $message->date->format('Y-m-d H:i:s') }}</p>
                            <p><strong>Message:</strong> {{ Str::limit($message->sender_text, 50) }}</p>
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
}

.message-preview p {
    margin: 5px 0;
}
    </style>

    @endsection
</x-app-layout>
