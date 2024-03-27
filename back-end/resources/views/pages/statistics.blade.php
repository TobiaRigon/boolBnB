
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body statistics rounded p-3 text-center">
                    <h5 class="card-title my-4">
                        <i class="fa-solid fa-eye"></i>
                        Visualizzazioni
                    </h5>
                    <h2 class="card-subtitle  text-body-secondary mb-3 fw-bold">
                        {{ $totalViews }}
                    </h2>
                    <h5 class="card-title">Visualizzazioni Mensili</h5>
                    <canvas id="monthlyViewsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var monthLabels = {!! json_encode($viewsByMonth->pluck('month')->map(function($month) {
        return DateTime::createFromFormat('!m', $month)->format('F');
    })) !!};

    var ctx = document.getElementById('monthlyViewsChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Visualizzazioni',
                data: {!! json_encode($viewsByMonth->pluck('views')) !!},
                backgroundColor: ' #63beec',
                borderColor: 'rgba(75, 192, 192, 1)',
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

<style>
    .fa-solid.fa-eye{
        color: #63beec;
    }
</style>

@endsection
