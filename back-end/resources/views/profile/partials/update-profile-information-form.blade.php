<section>
    <header>
        <h2 class="font-weight-bold">
            {{ __('Informazioni Profilo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Aggiorna le informazioni del profilo e l'indirizzo email del tuo account.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

    <div class="row">
        <div class="col">

            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" name="name" type="text" class="form-control my-2" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="form-control my-2" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="">
                            {{ __('Il tuo indirizzo email non è verificato.') }}

                            <button form="send-verification" class="">
                                {{ __('Clicca qui per re-inviare l\'email di verifica.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('È stata inviata una nuova email di verifica al tuo indirizzo.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex mt-3 items-center gap-4">
                <x-primary-button class="my_btn">{{ __('Salva') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Salvato.') }}</p>
                @endif
            </div>

        </div>

    </div>
    </form>
</section>
