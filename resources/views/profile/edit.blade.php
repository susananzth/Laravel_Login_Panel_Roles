<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-txtdark-800 dark:text-txtdark-200 leading-tight">
            <i class="fa-solid fa-user me-1"></i>{{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
        <x-validation-errors/>
        <x-session-status/>
        <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
