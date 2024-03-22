<x-app-layout>
    <x-slot name="header">
    <div class=" ">
        <h2 class="">
            {{ __('Profilo') }}
        </h2>

        </x-slot>

        @section('content')
        <div class="container-fluid">
        <div class="">
            <div class="p-4 ">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 ">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 ">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
        </div>
    

   
        @endsection
</x-app-layout>
