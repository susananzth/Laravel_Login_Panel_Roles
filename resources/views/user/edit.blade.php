<x-modal title="{{ __('Edit User') }}" wire:model="updateUser" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input-label for="name">{{ __('Name') }} *</x-input-label>
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                name="name" :value="$name" wire:model="name"
                autocomplete="name" maxlength="255" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email">{{ __('Email') }} *</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="$email" wire:model="email"
                autocomplete="username" maxlength="255" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password">{{ __('Password') }} *</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" wire:model="password"
                autocomplete="new-password" maxlength="255" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation">{{ __('Confirm Password') }} *</x-input-label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
               type="password" name="password_confirmation" wire:model="password_confirmation"
               autocomplete="new-password" maxlength="255" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end gap-4">
            <x-primary-button type="button" wire:click.prevent="update()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-primary-button>
            <x-secondary-button wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>
