<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <nav class="bg-white dark:bg-secondary-800 border-b border-secondary-100 dark:border-secondary-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ '/' }}" class="flex items-center">
                                <x-application-logo class="block h-9 w-auto fill-current text-txtdark-800 dark:text-txtdark-200" />
                                <span class="font-medium dark:text-txtdark-200 px-2">{{ config('app.name') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex">
                        @if(count(config('app.languages')) > 1)
                        <x-dropdown align="right" width="48" class="inline-flex items-center px-2 pt-1 border-b-2 border-transparent
                            text-sm font-medium leading-5 text-txtdark-500 dark:text-txtdark-400 hover:text-txtdark-700
                            dark:hover:text-txtdark-300 hover:border-secondary-300 dark:hover:border-secondary-700 focus:outline-none
                            focus:text-txtdark-700 dark:focus:text-txtdark-300 focus:border-secondary-300 dark:focus:border-secondary-700
                            active:border-primary-400 dark:active:border-primary-600
                            transition duration-150 ease-in-out">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center">
                                    <div>
                                        <span class="hidden sm:inline">{{ __('Language') }},</span>
                                        {{ strtoupper(app()->getLocale()) }}
                                    </div>
                                    <div class="ml-1 text-xs">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @foreach(config('app.languages') as $lang_locale => $lang_name)
                                <x-dropdown-link :href="url()->current().'?lang='.$lang_locale">
                                    @lang($lang_name) ({{ strtoupper($lang_locale) }})
                                </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                        @endif
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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-secondary-100 dark:bg-secondary-900">
            {{ $slot }}
        </div>
    </body>
</html>