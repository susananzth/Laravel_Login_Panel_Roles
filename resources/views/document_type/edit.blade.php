<x-modal title="{{ __('Edit DocumentType') }}" wire:model="updateDocumentType" focusable>
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
                autocomplete="off" maxlength="100" required autofocus />
            <x-input.message-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.label for="status">{{ __('Status') }} *</x-input.label>
            <x-input.select id="status" class="block mt-1 w-full" 
                name="status" wire:model="status" required>
                <option value="">{{ __('Please select') }}</option>
                <option value="false" {{ ($status == false) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                <option value="true" {{ ($status == true) ? 'selected' : '' }}>{{ __('Active') }}</option>
            </x-input.select>
            <x-input.message-error :messages="$errors->get('status')" class="mt-2" />
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