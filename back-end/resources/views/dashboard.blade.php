<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>


    </x-slot>
    @section('content')
        <div class="container mt-4">
            <a class="btn btn-success my-3" href="{{ route('apartment.create') }}">NUOVO APPARTAMENTO</a>
            <h1 class="text-center mb-5">I miei appartamenti: {{ count($apartments) }}</h1>

            <div class="row">
                @foreach ($apartments as $apartment)
                    <div class="col-12 col-md-6 col-lg-4 ">
                        <div class="card my-3">
                            <div class="card-container">
                                <img src="{{ asset($apartment->main_img) }}" class="card-img-top" alt="...">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                                <p class="card-text">{{ Str::limit($apartment->description) }}</p>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('apartments.show', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}"
                                        class="btn btn-primary">APRI</a>
                                    @if (auth()->id() == $apartment->user_id)
                                        <a href="{{ route('apartments.edit', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}"
                                            class="btn btn-secondary">MODIFICA</a>
                                        <form
                                            action="{{ route('apartment.delete', ['id' => $apartment->id, 'title' => Str::slug($apartment->title)]) }}""
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn-delete" type="submit" value="ELIMINA">
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

            .btn-delete {
                background-color: red;
                color: white;
                padding: 7px;
                border-radius: 4px;
            }
        </style>
    @endsection

</x-app-layout>
