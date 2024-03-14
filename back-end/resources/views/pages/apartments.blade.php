@extends('layouts.app')

@section('content')
    

    <div class="container mt-4">
        <h1 class="text-center mb-5">Apartments List</h1>

        <div class=" row ">
            @foreach ($apartments as $apartment)
                <div class="col-lg-3 col-md-6">
                    <div class="card ">
                        <img src="{{ $apartment->main_img }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->title }}</h5>

                       
                            <p class="card-text">{{ Str::limit($apartment->description) }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-primary">View</a>
                                <a href="#" class="btn btn-secondary">Edit</a>

                                <!-- css da sistemare -->
                                <form action="{{ route('apartment.delete', $apartment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="DELETE">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
