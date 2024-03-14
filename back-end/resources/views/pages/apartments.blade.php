@extends('layouts.app')

@section('content')
    <style>
        /* Stili personalizzati per le card */
        .card-img-top {
            width: 150px;
            /* assicura che l'immagine sia responsive */
            height: 150px;
            /* altezza fissa per le immagini */
            object-fit: cover;
            /* mantiene le proporzioni dell'immagine */
        }



        /* Spaziatura tra le card */
        .row-custom {

            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            width: calc((100 / 3));
        }

        .col-custom {
            padding-right: 5px;
            padding-left: 5px;
        }
    </style>

    <div class="container mt-4">
        <h1 class="text-center mb-5">Apartments List</h1>

        <div class="row row-custom d-flex">
            @foreach ($apartments as $apartment)
                <div class="col-md-4 c d-flex">
                    <div class="card ">
                        <img src="{{ $apartment->main_img }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->title }}</h5>

        <form action="{{ route('apartment.delete', $apartment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="DELETE">
        </form>
                            <p class="card-text">{{ Str::limit($apartment->description) }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary">View</a>
                                <a href="#" class="btn btn-secondary">Edit</a>
                                <button class="btn btn-danger" disabled>Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
