<section>
    <header>
        <h2 class="text-lg font-medium text-txtdark-900 dark:text-txtdark-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-txtdark-600 dark:text-txtdark-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password">{{ __('Current Password') }} *</x-input-label>
            <x-text-input id="current_password" class="block mt-1 w-full"
                type="password" name="current_password" wire:model="current_password"
                autocomplete="current-password" maxlength="255" required />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password">{{ __('New Password') }} *</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" wire:model="password"
                autocomplete="new-password" maxlength="255" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation">{{ __('Confirm Password') }} *</x-input-label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
               type="password" name="password_confirmation" wire:model="password_confirmation"
               autocomplete="new-password" maxlength="255" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="button" wire:click.prevent="passwordUpdate()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</section>