<x-app-layout>
    <x-slot name="header">
    <div class=" container-fluid">
        <h2 class="py-3 h2 pl-4 font-weight-bold font-size-big">
            {{ __('Profilo') }}
        </h2>

        

        <div class="">
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
    

   
    </x-slot>
</x-app-layout>
