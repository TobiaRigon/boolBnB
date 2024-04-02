@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Statistiche degli Appartamenti</h1>
            @foreach ($apartments as $apartment)
                <div class="card mt-4">
                    <div class="card-header">
                        <h2>{{ $apartment->title }}</h2>
                    </div>
                    <div class="card-body">
                        @if ($apartment->statistics->count() > 0)
                            <p>Numero totale di visite: {{ $apartment->statistics->count() }} <i class="fa-solid fa-eye"></i></p>
                            <canvas id="monthlyViewsChart_{{ $apartment->id }}" width="400" height="200"></canvas>
                        @else
                            <p>Nessuna statistica disponibile</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@foreach ($apartments as $apartment)
    @if ($apartment->statistics->count() > 0)
        <script>
            var monthlyViewsData_{{ $apartment->id }} = {!! json_encode(array_values($monthlyViews[$apartment->id])) !!};
            var monthlyViewsLabels_{{ $apartment->id }} = {!! json_encode(array_keys($monthlyViews[$apartment->id])) !!};
            var ctx_{{ $apartment->id }} = document.getElementById('monthlyViewsChart_{{ $apartment->id }}').getContext('2d');
            var myChart_{{ $apartment->id }} = new Chart(ctx_{{ $apartment->id }}, {
                type: 'line',
                data: {
                    labels: monthlyViewsLabels_{{ $apartment->id }},
                    datasets: [{
                        label: 'Visualizzazioni mensili',
                        data: monthlyViewsData_{{ $apartment->id }},
                        backgroundColor: ' #63beec',
                        borderColor: '#63beec',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endif
@endforeach

<style>
    .fa-solid.fa-eye{
        color: #63beec;
    }
</style>

@endsection
