<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6">
        <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
            <x-session-status/>
            <div class="p-6 text-slate-900 dark:text-slate-100">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</x-app-layout>
