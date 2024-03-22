<section>
    <header>
        <h2 class="font-weight-bold">
            {{ __('Aggiorna Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assicurati che il tuo account utilizzi una password lunga e casuale per rimanere sicuro.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')


        <div class="row">
        <div class="col">

        <div>
            <x-input-label for="current_password" :value="__('Password Attuale')" />
            <x-text-input id="current_password" name="current_password" type="password" class="form-control my-2" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Nuova Password')" />
            <x-text-input id="password" name="password" type="password" class="form-control my-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Conferma Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="form-control my-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex mt-3 items-center gap-4">
            <x-primary-button class="my_btn">{{ __('Salva') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="my_btn"
                >{{ __('Salvato.') }}</p>
            @endif
        </div>

        </div>

        </div>
    </form>
</section>
