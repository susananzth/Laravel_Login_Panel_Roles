<x-modal title="{{ __('Create new city') }}" wire:model="addCity" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input-label for="state_id">{{ __('State') }} *</x-input-label>
            <x-select-input id="state_id" class="block mt-1 w-full" 
                name="state_id" wire:model="state_id" autocomplete="off" autofocus>
                <option value="">{{ __('Please select') }}</option>
                @foreach ($states as $item)
                    <option value="{{$item->id}}" {{ old('state_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name">{{ __('Name') }} *</x-input-label>
            <x-text-input id="name" class="block mt-1 w-full" type="text"
                name="name" :value="old('name')" wire:model="name"
                autocomplete="off" maxlength="150" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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