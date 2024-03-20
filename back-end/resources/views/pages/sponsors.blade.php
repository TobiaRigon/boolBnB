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
                            <!-- Form per la selezione dell'appartamento -->
                            <form action="{{ route('applySponsor', ['sponsor_id' => $sponsor->id]) }}" method="POST" class="apply-sponsor-form">
                                @csrf
                                <select name="apartment_id" class="form-select mb-3">
                                    <option value="">Seleziona un appartamento</option>
                                    @foreach($userApartments as $apartment)
                                    <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-block">Applica sponsorizzazione</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="text-center">
            <h1 class="mb-5">I tuoi appartamenti sponsorizzati</h1>
            <div class="row w-100 gy-5 mt-5 mt-md-0">
                @foreach ($userApartments as $apartment)
                    @if ($apartment->in_evidence)
                        <div class="col-12 col-lg-4 d-flex justify-content-center">
                            <div class="card border-0 shadow-lg">
                                <div class="card-body">
                                    <h2 class="card-title text-center fw-bold mb-4">{{ $apartment->title }}</h2>
                                    @foreach ($apartment->sponsors as $sponsor)
                                        <div class="details">
                                            <div class="data">
                                                <p class="card-text text-center py-2">Scadenza della sponsorizzazione: {{ $sponsor->pivot->deadline }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
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
