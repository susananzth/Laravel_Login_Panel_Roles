<x-modal title="{{ __('Create new currency') }}" wire:model="addCurrency" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input-label for="name">{{ __('Name') }} *</x-input-label>
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                name="name" :value="old('name')" wire:model="name"
                autocomplete="off" maxlength="150" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="" :value="__('ISO 4')" />
            <x-text-input id="iso_4" class="block mt-1 w-full" type="text"
                name="iso_4" :value="old('iso_4')" wire:model="iso_4"
                maxlength="5" autocomplete="off" />
            <x-input-error :messages="$errors->get('iso_4')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="symbol" :value="__('Symbol')" />
            <x-text-input id="symbol" class="block mt-1 w-full" type="text"
                name="symbol" :value="old('symbol')" wire:model="symbol"
                maxlength="10" autocomplete="off" />
            <x-input-error :messages="$errors->get('symbol')" class="mt-2" />
        </div>

        <div class="flex justify-end gap-4">
            <x-primary-button type="button" wire:click.prevent="store()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Save') }}
            </x-primary-button>
            <x-secondary-button wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>