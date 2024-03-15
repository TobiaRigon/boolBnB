@extends('layouts.app')

@section('content')
    

    <div class="container mt-4">
        <h1 class="text-center mb-5">Lista appartamenti</h1>
        <a class="btn btn-success  my-3" href="{{route('apartment.create')}}">NUOVO APPARTAMENTO</a>

        <div class=" row ">
            @foreach ($apartments as $apartment)
                <div class="col-lg-3 col-md-6">
                    <div class="card my-3 ">
                        <img src="{{ $apartment->main_img }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->title }}</h5>

                       
                            <p class="card-text">{{ Str::limit($apartment->description) }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{route('apartments.show', $apartment->id)}}" class="btn btn-primary">APRI</a>

                                <a href="{{route('apartments.edit', $apartment->id)}}" class="btn btn-secondary">MODIFICA</a>

                                <!-- css da sistemare -->
                                <form action="{{ route('apartment.delete', $apartment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="ELIMINA">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
