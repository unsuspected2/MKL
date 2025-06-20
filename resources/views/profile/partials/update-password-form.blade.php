<section>
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-white-400">
            {{ __('Certifique-se de usar uma senha segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label style="color: black" for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input style="background: white ; color:black"  id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label  style="color: black" for="update_password_password" :value="__('New Password')" />
            <x-text-input style="background: white ; color:black"  style="background: white ; color:black"  id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label style="color: black" for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input  style="background: white ; color:black"  id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >{{ __('Salvo com sucesso.') }}</p>
            @endif
        </div>
    </form>
</section>
