<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SusanaNzth') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ '/' }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>
                    </div>
                    <div class="flex">
                        <x-dropdown align="right" width="48" class="inline-flex items-center px-2 pt-1 border-b-2 border-transparent
                            text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700
                            dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none
                            focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700
                            active:border-indigo-400 dark:active:border-indigo-600
                            transition duration-150 ease-in-out">
                            <x-slot name="trigger">
                                <button>
                                    <div>{{ __('Language') }}</div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Español') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('English') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                        @if (Route::has('login'))
                            @auth
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @else
                                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                    {{ __('Log in') }}
                                </x-nav-link>

                                @if (Route::has('register'))
                                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                        {{ __('Register') }}
                                    </x-nav-link>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            {{ $slot }}
        </div>
    </body>
</html>
