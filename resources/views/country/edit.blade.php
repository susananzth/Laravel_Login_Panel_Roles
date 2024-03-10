<x-modal title="{{ __('Edit Country') }}" wire:model="updateCountry" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input.label for="name">{{ __('Name') }} *</x-input.label>
            <x-input.text id="name" class="block mt-1 w-full" type="text"
                name="name" :value="$name" wire:model="name"
                autocomplete="off" maxlength="200" required autofocus />
            <x-input.message-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="" :value="__('ISO 2')" />
            <x-input.text id="iso_2" class="block mt-1 w-full" type="text"
                name="iso_2" :value="$iso_2" wire:model="iso_2"
                maxlength="2" autocomplete="off" />
            <x-input.message-error :messages="$errors->get('iso_2')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="iso_3" :value="__('ISO 3')" />
            <x-input.text id="iso_3" class="block mt-1 w-full" type="text"
                name="iso_3" :value="$iso_3" wire:model="iso_3"
                maxlength="3" autocomplete="off" />
            <x-input.message-error :messages="$errors->get('iso_3')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="iso_number" :value="__('ISO number')" />
            <x-input.text id="iso_number" class="block mt-1 w-full" type="text"
                name="iso_number" :value="$iso_number" wire:model="iso_number"
                maxlength="4" autocomplete="off" />
            <x-input.message-error :messages="$errors->get('iso_number')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="phone_code">{{ __('Phone code') }} *</x-input.label>
            <x-input.text id="phone_code" class="block mt-1 w-full" type="text"
                name="phone_code" :value="$phone_code" wire:model="phone_code"
                maxlength="4" required autocomplete="off" />
            <x-input.message-error :messages="$errors->get('phone_code')" class="mt-2" />
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