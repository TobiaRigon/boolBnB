<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        
    </x-slot>
    @section('content')
   
    <div class="container mt-4">
        <a class="btn btn-success my-3" href="{{ route('apartment.create') }}">NUOVO APPARTAMENTO</a>
        <h1 class="text-center mb-5">I miei appartamenti:  {{ count($apartments) }}</h1>
        
        <div class="row">
            @foreach ($apartments as $apartment)
                <div class="col-lg-3 col-md-6">
                    <div class="card my-3">
                    <div class="card-container">
                    <img src="{{ asset($apartment->main_img) }}" class="card-img-top"
                            alt="...">
                            <h5 class="card-title">{{ $apartment->title }}</h5>
                            <p class="card-text">{{ Str::limit($apartment->description) }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-primary">APRI</a>
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

    
    @endsection
    
</x-app-layout>
