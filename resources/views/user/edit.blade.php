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
            <x-input.label for="first_name">{{ __('First name') }} *</x-input.label>
            <x-input.text id="first_name" class="block mt-1 w-full" type="text"
                name="first_name" :value="$first_name" wire:model="first_name"
                autocomplete="off" maxlength="150" required autofocus />
            <x-input.message-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="last_name">{{ __('Last name') }} *</x-input.label>
            <x-input.text id="last_name" class="block mt-1 w-full" type="text"
                name="last_name" :value="$last_name" wire:model="last_name"
                autocomplete="off" maxlength="150" required />
            <x-input.message-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.label for="image">{{ __('Image') }}</x-input.label>
            <x-input.file id="image" type="file" name="image" wire:model="image" :image="$imageEdit" />
            <p class="mt-0 text-xs text-gray-500">PNG, JPG o JPEG (MAX. 4MB).</p>
            <x-input.message-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="document_type_id">{{ __('Document number') }} *</x-input.label>
            <x-input.select id="document_type_id" class="block mt-1 w-full" 
                name="document_type_id" wire:model="document_type_id" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($documents as $item)
                    @if ($document_type_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('document_type_id')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="document_number">{{ __('Document number') }} *</x-input.label>
            <x-input.text id="document_number" class="block mt-1 w-full" type="text"
                name="document_number" :value="$document_number" 
                wire:model="document_number" maxlength="50" required autocomplete="off" />
            <x-input.message-error :messages="$errors->get('document_number')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.label for="country_id">{{ __('Country') }} *</x-input.label>
            <x-input.select id="country_id" class="block mt-1 w-full" 
                name="country_id" wire:model="country_id" required autocomplete="off" 
                wire:change="countryChange($event.target.value)">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($countries as $item)
                    @if ($country_id == $item->id)
                    <option wire:key="country_{{ $item->id }}" value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                    <option wire:key="country_{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('country_id')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="state_id">{{ __('State') }} *</x-input.label>
            <x-input.select id="state_id" class="block mt-1 w-full" :disabled="empty($country_id)" 
                name="state_id" wire:model="state_id" required autocomplete="off" 
                wire:change="stateChange($event.target.value)">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($states as $state)
                    @if ($state_id == $state->id)
                    <option wire:key="state_{{ $item->id }}" value="{{ $state->id }}" selected>{{ $state->name }}</option>
                    @else
                    <option wire:key="state_{{ $item->id }}" value="{{ $state->id }}">{{ $state->name }}</option>
                    @endif
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('state_id')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="city_id">{{ __('City') }} *</x-input.label>
            <x-input.select id="city_id" class="block mt-1 w-full" :disabled="empty($state_id)" 
                name="city_id" wire:model="city_id" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($cities as $city)
                    @if ($city_id == $city->id)
                    <option wire:key="city_{{ $item->id }}" value="{{ $city->id }}" selected>{{ $city->name }}</option>
                    @else
                    <option wire:key="city_{{ $item->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
                    @endif
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('city_id')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.label for="address">{{ __('Address') }} *</x-input.label>
            <x-input.text id="address" class="block mt-1 w-full" type="text"
                name="address" :value="$address" wire:model="address" 
                maxlength="50" required autocomplete="off" />
            <x-input.message-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="phone_code_id">{{ __('Phone code') }} *</x-input.label>
            <x-input.select id="phone_code_id" class="block mt-1 w-full" 
                name="phone_code_id" wire:model="phone_code_id" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                @foreach ($phone_codes as $item)
                    @if ($phone_code_id == $item->id)
                    <option value="{{ $item->id }}" selected>+{{ $item->phone_code }}</option>
                    @else
                    <option value="{{ $item->id }}">+{{ $item->phone_code }}</option>
                    @endif
                @endforeach
            </x-input.select>
            <x-input.message-error :messages="$errors->get('phone_code_id')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="phone">{{ __('Phone') }} *</x-input.label>
            <x-input.text id="phone" class="block mt-1 w-full" type="text"
                name="phone" :value="$phone" wire:model="phone"
                autocomplete="off" maxlength="50" required />
            <x-input.message-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.label for="status">{{ __('Status') }} *</x-input.label>
            <x-input.select id="status" class="block mt-1 w-full" 
                name="status" wire:model="status" required autocomplete="off">
                <option value="">{{ __('Please select') }}</option>
                <option value="false" {{ ($status == false) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                <option value="true" {{ ($status == true) ? 'selected' : '' }}>{{ __('Active') }}</option>
            </x-input.select>
            <x-input.message-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.label for="email">{{ __('Email') }} *</x-input.label>
            <x-input.text id="email" class="block mt-1 w-full" type="email"
                name="email" :value="$email" wire:model="email"
                autocomplete="off" maxlength="255" required />
            <x-input.message-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="password">{{ __('Password') }} *</x-input.label>
            <x-input.text id="password" class="block mt-1 w-full"
                type="password" name="password" wire:model="password"
                autocomplete="off" maxlength="255" required />
            <x-input.message-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input.label for="password_confirmation">{{ __('Confirm Password') }} *</x-input.label>
            <x-input.text id="password_confirmation" class="block mt-1 w-full"
               type="password" name="password_confirmation" wire:model="password_confirmation"
               autocomplete="off" maxlength="255" required />
            <x-input.message-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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