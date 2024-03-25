
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Statistiche visualizzazioni per l'appartamento: {{ $apartment->title }}</h1>
        <p>Numero totale di visualizzazioni: {{ $totalViews }}</p>
        <!-- Aggiungi altri dettagli o grafici delle statistiche qui -->
    </div>
@endsection
