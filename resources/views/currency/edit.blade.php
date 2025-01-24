<x-modal title="{{ __('Edit Currency') }}" wire:model="updateCurrency" focusable>
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
                autocomplete="off" maxlength="150" required autofocus />
            <x-input.message-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="iso_4" :value="__('ISO 4')" />
            <x-input.text id="iso_4" class="block mt-1 w-full" type="text"
                name="iso_4" :value="$iso_4" wire:model="iso_4"
                maxlength="5" autocomplete="off" />
            <x-input.message-error :messages="$errors->get('iso_4')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="symbol" :value="__('Symbol')" />
            <x-input.text id="symbol" class="block mt-1 w-full" type="text"
                name="symbol" :value="$symbol" wire:model="symbol"
                maxlength="10" autocomplete="off" />
            <x-input.message-error :messages="$errors->get('symbol')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="countries">{{ __('Countries') }} *</x-input.label>
            <x-input.select-multiple id="countries" class="block mt-1 w-full" 
                name="countries" wire:model="selectedCountries"
                autocomplete="off" required multiple>
                <option value="">{{ __('Please select') }}</option>
                @foreach ($countries as $item)
                    @if (in_array($item->id, $selectedCountries))
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </x-input.select-multiple>
            <x-input.message-error :messages="$errors->get('countries')" class="mt-2" />
        </div>

        <div class="flex justify-end gap-4">
            <x-button.primary type="button" wire:click.prevent="update()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-button.primary>
            <x-button.secondary wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-button.secondary>
        </div>
    </form>
</x-modal>