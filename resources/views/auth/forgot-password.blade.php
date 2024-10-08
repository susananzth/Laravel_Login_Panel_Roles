<x-guest-layout>
    <div>
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-secondary-500" />
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-secondary-800 shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-4 text-sm text-secondary-600 dark:text-secondary-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input.label for="email" :value="__('Email')" />
                <x-input.text id="email" class="block mt-1 w-full" type="email" 
                    name="email" :value="old('email')" required autofocus />
                <x-input.message-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button.primary>
                    {{ __('Email Password Reset Link') }}
                </x-button.primary>
            </div>
        </form>
    </div>
</x-guest-layout>