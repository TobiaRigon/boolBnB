<section class="">
    <header>
        <h2 class="font-weight-bold">
            {{ __('Elimina Account') }}
        </h2>

        <p class="mt-3">
            {{ __('Una volta eliminato il tuo account, tutte le risorse e i dati ad esso associati verranno cancellati definitivamente. Prima di eliminare il tuo account, ti raccomandiamo di scaricare qualsiasi dato o informazione che desideri conservare.') }}
        </p>
    </header>

    <x-danger-button class="btn btn-danger mt-4" x-data="" x-on:click.prevent="$dispatch('open-modal', 'conferma-eliminazione-utente')">
        {{ __('Elimina Account') }}
    </x-danger-button>

    <x-modal name="conferma-eliminazione-utente" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="mt-3">
            @csrf
            @method('delete')

            <h2 class="">
                {{ __('Sei sicuro di voler eliminare il tuo account?') }}
            </h2>

            <p class="mt-3">
                {{ __('Una volta eliminato il tuo account, tutte le risorse e i dati ad esso associati verranno cancellati definitivamente. Inserisci la tua password per confermare che desideri eliminare definitivamente il tuo account.') }}
            </p>

            <div class="mt-3">
                <x-input-label for="password" value="{{ __('Password') }}" class="font-weight-bold" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control mt-3"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-danger-button class="btn btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Annulla') }}
                </x-danger-button>

                <x-danger-button class="btn btn-danger ml-3">
                    {{ __('Elimina Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
