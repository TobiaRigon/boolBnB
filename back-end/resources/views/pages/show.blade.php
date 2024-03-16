{{-- resources/views/apartments/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Apartment Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $apartment->title }}
        </div>
        <img src="{{ asset($apartment->main_img) }}" alt="Main Image" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ $apartment->title }}</h5>
            <p class="card-text">{{ $apartment->description }}</p>
            <ul>
                <li>Max Guests: {{ $apartment->max_guests }}</li>
                <li>Rooms: {{ $apartment->rooms }}</li>
                <li>Beds: {{ $apartment->beds }}</li>
                <li>Baths: {{ $apartment->baths }}</li>
                <li>Address: {{ $apartment->address }}</li>
                <li>Longitude: {{ $apartment->longitude }}</li>
                <li>Latitude: {{ $apartment->latitude }}</li>
            </ul>
        </div>
        <div class="card-footer">
          
        </div>
    </div>
</div>
<script> 



</script>
@endsection
