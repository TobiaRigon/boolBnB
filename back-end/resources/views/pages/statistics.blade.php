






@extends('layouts.app')

@section('content')


    <h1>Statistiche degli Appartamenti</h1>

    <div>
        @foreach ($apartments as $apartment)
        <div>
            <h2>{{ $apartment->title }}</h2>
            <p>
                @if ($apartment->statistics)
                    Numero totale di visite: {{ $apartment->statistics->count() }}
                @else
                    Nessuna statistica disponibile
                @endif
            </p>
        </div>
    @endforeach

    </div>


    <script>



    </script>

    <style scoped>

    .apartment-statistics {
        margin-top: 20px;
    }
    .apartment-statistics h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    .apartment-statistics p {
        margin-bottom: 5px;
    }
    </style>
@endsection

