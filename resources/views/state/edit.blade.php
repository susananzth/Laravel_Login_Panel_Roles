<x-modal title="{{ __('Edit State') }}" wire:model="updateState" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input.label for="country_id" :value="__('Country')" />
            <x-input.select id="country_id" class="block mt-1 w-full" 
                name="country_id" wire:model="country_id">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($countries as $item)
                    <option value="{{$item->id}}" {{ $country_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('country_id')" class="mt-2" />
        </div>
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
                maxlength="4" autocomplete="off" />
            <x-input.message-error :messages="$errors->get('iso_2')" class="mt-2" />
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