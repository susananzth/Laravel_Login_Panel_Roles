<x-modal title="{{ __('Edit User') }}" wire:model="updateUser" focusable>
    <form class="grid grid-cols-2 gap-4" method="POST">
        @csrf
        <div class="col-span-2 mt-0">
            <x-validation-errors/>
            <p class="italic text-sm text-red-700 m-0">
                {{ __('Fields marked with * are required') }}
            </p>
        </div>

        <div>
            <x-input-label for="first_name">{{ __('First name') }} *</x-input-label>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text"
                name="first_name" :value="$first_name" wire:model="first_name"
                autocomplete="off" maxlength="150" required autofocus />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="last_name">{{ __('Last name') }} *</x-input-label>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text"
                name="last_name" :value="$last_name" wire:model="last_name"
                autocomplete="off" maxlength="150" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="document_type_id">{{ __('Document number') }} *</x-input-label>
            <x-select-input id="document_type_id" class="block mt-1 w-full" 
                name="document_type_id" wire:model="document_type_id" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($documents as $item)
                    @if ($document_type_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('document_type_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="document_number">{{ __('Document number') }} *</x-input-label>
            <x-text-input id="document_number" class="block mt-1 w-full" type="text"
                name="document_number" :value="$document_number" 
                wire:model="document_number" maxlength="50" required autocomplete="off" />
            <x-input-error :messages="$errors->get('document_number')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone_code_id">{{ __('Phone code') }} *</x-input-label>
            <x-select-input id="phone_code_id" class="block mt-1 w-full" 
                name="phone_code_id" wire:model="phone_code_id" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($phone_codes as $item)
                    @if ($phone_code_id == $item->id)
                    <option value="{{ $item->id }}" selected>+{{ $item->phone_code }}</option>
                    @else
                    <option value="{{ $item->id }}">+{{ $item->phone_code }}</option>
                    @endif
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('phone_code_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="phone">{{ __('Phone') }} *</x-input-label>
            <x-text-input id="phone" class="block mt-1 w-full" type="text"
                name="phone" :value="$phone" wire:model="phone"
                autocomplete="off" maxlength="50" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input-label for="status">{{ __('Status') }} *</x-input-label>
            <x-select-input id="status" class="block mt-1 w-full" 
                name="status" wire:model="status" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                <option value="false" {{ ($status == false) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                <option value="true" {{ ($status == true) ? 'selected' : '' }}>{{ __('Active') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input-label for="email">{{ __('Email') }} *</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email"
                name="email" :value="$email" wire:model="email"
                autocomplete="off" maxlength="255" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password">{{ __('Password') }} *</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" wire:model="password"
                autocomplete="off" maxlength="255" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation">{{ __('Confirm Password') }} *</x-input-label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
               type="password" name="password_confirmation" wire:model="password_confirmation"
               autocomplete="off" maxlength="255" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end col-span-2 gap-4">
            <x-primary-button type="button" wire:click.prevent="update()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-primary-button>
            <x-secondary-button wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>