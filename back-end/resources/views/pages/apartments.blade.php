@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-5">Apartments List</h1>
        @auth
            <!-- Contenuto visibile solo agli utenti autenticati -->
            <a class="btn btn-success  my-3" href="{{ route('apartment.create') }}">CREATE</a>

        @endauth
        <div class=" row ">
            @foreach ($apartments as $apartment)
                <div class="col-lg-3 col-md-6">
                    <div class="card my-3">
                        <img src="{{ $apartment->main_img }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->title }}</h5>
                            <p class="card-text">{{ Str::limit($apartment->description, 100) }}</p>
                            <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-primary">View</a>

                            @if (auth()->id() == $apartment->user_id)
                                <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-secondary">Edit</a>

                                <form action="{{ route('apartment.delete', $apartment->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="DELETE">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
