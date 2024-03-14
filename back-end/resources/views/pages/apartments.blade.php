@extends('layouts.app')
@section('content')

  <di class="container">
    <h1>Apartment</h1>

    <ul>
        @foreach ($apartments as $apartment)
        <li class="my-2">
        nome :{{$apartment->title}}

        <form action="{{ route('apartment.delete', $apartment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="DELETE">
        </form>
        </li>
        @endforeach
    </ul>
  </di>

@endsection
