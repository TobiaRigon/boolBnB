<x-guest-layout>

<div class="container-fluid ">
            <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Rotta to Register -->



<form method="POST" action="{{ route('login') }}" style="border: 2px solid #63beec; border-radius: 20px; padding:20px;">
    @csrf


                    
    <div class="row">
    <div class="col">
      <!-- Email Address -->
                <div >
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-3">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        </div>
              
            </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="" name="remember">
            <span class="ml-2 text-sm text-gray-600">Resta collegato</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        <div class="mb-2">
        @if (Route::has('password.request'))
            <a class="" href="{{ route('password.request') }}">
                {{ __('Hai dimenticato la password?') }}
            </a>
        @endif
        <x-primary-button class="my_btn ml-3">
            {{ __('Log in') }}
        </x-primary-button>
        </div>

        <div>
        <span>Non sei ancora registrato?</span>
        <x-primary-button class="my_btn  ml-3 ">
            <a href="{{ route('register') }}" >Registrati</a>
        </x-primary-button>
        </div>
       
        
       
    </div>
</form>
        </div>


    
    
</x-guest-layout>


