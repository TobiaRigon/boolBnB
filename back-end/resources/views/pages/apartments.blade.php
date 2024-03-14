@extends('layouts.app')
@section('content')

  <di class="container">
    <h1>Apartment</h1>

    <ul>
        @foreach ($apartments as $apartment)
        <li class="my-2">
        nome :{{$apartment->title}}
        </li>
        @endforeach
    </ul>
  </di>

@endsection
