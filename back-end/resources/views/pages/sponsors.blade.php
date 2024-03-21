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
                            <form action="{{ route('applySponsor', ['sponsor_id' => $sponsor->id]) }}" method="POST" id="apply-sponsor-form">
                                @csrf
                                <select name="apartment_id" class="form-select mb-3">
                                    <option value="">Seleziona un appartamento</option>
                                    @foreach($userApartments as $apartment)
                                    <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                                    @endforeach
                                </select>
                                <!-- Contenitore per il form di pagamento Braintree -->
                                <div id="dropin-container"></div>
                                <button type="submit" class="btn btn-primary btn-block" id="submit-button">Applica sponsorizzazione</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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
{{-- script per braintree --}}
<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#apply-sponsor-form');
    var submitButton = document.querySelector('#submit-button');
    var dropinContainer = document.querySelector('#dropin-container');

    braintree.dropin.create({
        authorization: '{{ $clientToken }}', // Passa il token del client Braintree generato dal controller
        container: dropinContainer
    }, function (createErr, instance) {
        if (createErr) {
            console.error('Errore durante la creazione del form di pagamento', createErr);
            return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                if (requestPaymentMethodErr) {
                    console.error('Errore durante il recupero del metodo di pagamento', requestPaymentMethodErr);
                    return;
                }

                // Aggiungi il nonce del metodo di pagamento al modulo
                var nonceField = document.createElement('input');
                nonceField.setAttribute('type', 'hidden');
                nonceField.setAttribute('name', 'payment_method_nonce');
                nonceField.setAttribute('value', payload.nonce);
                form.appendChild(nonceField);

                // Invia il modulo
                form.submit();
            });
        });
    });
</script>
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
