{{-- resources/views/apartments/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center mt-4">
        <div class="card">
            <div class="card-header">
                {{ $apartment->title }}
            </div>


            @if (filter_var($apartment->main_img, FILTER_VALIDATE_URL))
                <img src="{{ $apartment->main_img }}" alt="Immagine Principale">
            @else
                <img src="{{ asset('storage/' . $apartment->main_img) }}" alt="Immagine Principale">
            @endif


            <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
                <p class="card-text">{{ $apartment->description }}</p>
                <ul>
                    <li>Ospiti Massimi: {{ $apartment->max_guests }}</li>
                    <li>Camere: {{ $apartment->rooms }}</li>
                    <li>Letti: {{ $apartment->beds }}</li>
                    <li>Bagni: {{ $apartment->baths }}</li>
                    <li>Indirizzo: {{ $apartment->address }}</li>
                    <!-- <li>Longitudine: {{ $apartment->longitude }}</li>
                                                        <li>Latitudine: {{ $apartment->latitude }}</li> -->
                </ul>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <script></script>
    <div class="container d-flex justify-content-center mt-4">
        <div class="card">
            <div class="card-header">
                {{ $apartment->title }}
            </div>
            <img src="{{ asset($apartment->main_img) }}" alt="Immagine Principale" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
                <p class="card-text">{{ $apartment->description }}</p>
                <ul>
                    <li>Ospiti Massimi: {{ $apartment->max_guests }}</li>
                    <li>Camere: {{ $apartment->rooms }}</li>
                    <li>Letti: {{ $apartment->beds }}</li>
                    <li>Bagni: {{ $apartment->baths }}</li>
                    <li>Indirizzo: {{ $apartment->address }}</li>
                    <li>Servizi:</li>
                    <ul>
                        @foreach ($apartment->services as $service)
                            <li>
                                <i class="fas {{ $service['icon'] }}"></i> {{ $service['name'] }}
                            </li>
                        @endforeach
                        {{-- <!-- <li>Longitudine: {{ $apartment->longitude }}</li> --}}
                        {{-- <li>Latitudine: {{ $apartment->latitude }}</li> --> --}}
                    </ul>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <script></script>


    <style scoped>
        .card {
            max-width: 1000px;
        }
    </style>
@endsection
