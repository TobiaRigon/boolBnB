<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dettagli Messaggio') }}
        </h2>
    </x-slot>
    @section('content')
        <div class="container mt-4">

            <div class="row">
                <div class="col-12">
                    <p><strong>Da:</strong> {{ $message->sender_name }} {{ $message->sender_surname }}</p>
                    <p><strong>Email:</strong> {{ $message->sender_mail }}</p>
                    <p><strong>Data:</strong> {{ $message->date }}</p>
                    <p><strong>Messaggio:</strong> {{ $message->sender_text }}</p>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
