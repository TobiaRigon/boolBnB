<x-app-layout>
<!-- rotta a home -->
<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        
    </x-slot>
    @section('content')
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a class="btn btn-success my-3" href="{{ route('apartment.create') }}">NUOVO APPARTAMENTO</a>
        </div>
    </div>
    
    @endsection
    
</x-app-layout>
