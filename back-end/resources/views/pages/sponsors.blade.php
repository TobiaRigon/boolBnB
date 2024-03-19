@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h1 class="mb-5">Sponsorizzazioni</h1>
        <div class="container h-100 d-flex align-items-center justify-content-center p-lg-0">
            <div class="row w-100 gy-5 mt-5 mt-md-0">
                @foreach ($sponsors as $sponsor)
                <div class="col-12 col-lg-4 d-flex justify-content-center">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body">
                            <h2 class="card-title text-center fw-bold mb-4">
                                {{ explode(' ', $sponsor->title)[1] }}</h2>
                            <div class="details">
                                <div class="data">
                                    <h5 class="card-text text-center py-2">Prezzo: {{ $sponsor->price }} €</h5>
                                    <h6 class="card-text text-center py-2">Durata: {{ $sponsor->duration }} h</h6>
                                    <p class="card-text text-center py-2 px-3">{{ $sponsor->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style scoped>
    .card {
        border: 0;
        background-color: #f8f9fa;
        transition: transform 0.3s ease;
        &:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: #007bff;
        }

        .bronze {
            background-color: #cd7f32; /* colore bronzo */
        }

        .silver {
            background-color: #c0c0c0; /* colore argento */
        }

        .gold {
            background-color: #ffd700; /* colore oro */
        }
    }
</style>
@endsection
