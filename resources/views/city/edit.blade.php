<x-modal title="{{ __('Edit City') }}" wire:model="updateCity" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input.label for="state_id" :value="__('State')" />
            <x-input.select id="state_id" class="block mt-1 w-full" 
                name="state_id" wire:model="state_id" autocomplete="off" autofocus>
                <option value="">{{ __('Please select') }}</option>
                @foreach ($states as $item)
                    <option value="{{$item->id}}" {{ $state_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('state_id')" class="mt-2" />
        </div>
        <div>
            <x-input.label for="name">{{ __('Name') }} *</x-input.label>
            <x-input.text id="name" class="block mt-1 w-full" type="text"
                name="name" :value="$name" wire:model="name"
                autocomplete="off" maxlength="150" required />
            <x-input.message-error :messages="$errors->get('name')" class="mt-2" />
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