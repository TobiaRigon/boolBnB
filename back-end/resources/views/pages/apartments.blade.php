@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-5">Lista appartamenti</h1>
        <a class="btn btn-success my-3" href="{{ route('apartment.create') }}">NUOVO APPARTAMENTO</a>

        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-lg-3 col-md-6">
                    <div class="card my-3">
                        <div class="card-container">
                            @if (filter_var($apartment->main_img, FILTER_VALIDATE_URL))
                                <img src="{{ $apartment->main_img }}" alt="Immagine Principale">
                            @else
                                <img src="{{ asset('storage/' . $apartment->main_img) }}" alt="Immagine Principale">
                                @endif @if (!is_null($apartment->gallery) && $apartment->gallery->isNotEmpty())
                                    {{-- Visualizza le immagini già presenti --}}
                                    @foreach ($apartment->gallery as $image)
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Immagine Galleria">
                                    @endforeach
                                @else
                                    <p>Nessuna immagine disponibile</p>
                                @endif
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                                <p class="card-text">{{ Str::limit($apartment->description) }}</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('apartments.show', $apartment->id) }}"
                                        class="btn btn-primary">APRI</a>
                                    @if (auth()->id() == $apartment->user_id)
                                        <a href="{{ route('apartments.edit', $apartment->id) }}"
                                            class="btn btn-secondary">MODIFICA</a>
                                        <form action="{{ route('apartment.delete', $apartment->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="ELIMINA">
                                        </form>
                                    @endif
                                </div>


                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <style scoped>
        img {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .card {
            height: 500px;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card-text {
            overflow-y: auto;
            height: 5080
        }

        .card-text::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .card-text {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
@endsection
