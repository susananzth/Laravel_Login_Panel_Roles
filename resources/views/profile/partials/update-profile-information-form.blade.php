<section>
    <header>
        <h2 class="text-lg font-medium text-txtdark-900 dark:text-txtdark-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-txtdark-600 dark:text-txtdark-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="grid grid-cols-2 gap-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name">{{ __('First name') }} *</x-input-label>
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" 
                :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>
        <div>
            <x-input-label for="last_name">{{ __('Last name') }} *</x-input-label>
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" 
                :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>
        <div>
            <x-input-label for="document_type_id">{{ __('Document number') }} *</x-input-label>
            <x-select-input id="document_type_id" class="block mt-1 w-full" 
                name="document_type_id" required>
                <option value="">{{ __('Please select') }}</option>
                @foreach ($documents as $item)
                    @if ($user->document_type_id == $item->id)
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
            <x-text-input id="document_number" name="document_number" type="text" 
                class="mt-1 block w-full" :value="old('document_number', $user->document_number)" 
                maxlength="50" required />
            <x-input-error class="mt-2" :messages="$errors->get('document_number')" />
        </div>
        <div>
            <x-input-label for="phone_code_id">{{ __('Phone code') }} *</x-input-label>
            <x-select-input id="phone_code_id" class="block mt-1 w-full" 
                name="phone_code_id" required>
                <option value="">{{ __('Please select') }}</option>
                @foreach ($phone_codes as $item)
                    @if ($user->phone_code_id == $item->id)
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
            <x-text-input id="phone" name="phone" type="tel" 
                class="mt-1 block w-full" :value="old('phone', $user->phone)" 
                required autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="col-span-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-txtdark-800 dark:text-txtdark-200">
                        {{ __('Your email address is unverified.') }}

                        <x-primary-button form="send-verification">
                            <i class="fa-solid fa-save me-1"></i>{{ __('Click here to re-send the verification email.') }}
                        </x-primary-button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center col-span-2 gap-4">
            <x-primary-button>
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</section>