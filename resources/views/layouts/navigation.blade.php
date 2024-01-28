<nav x-data="{ open: false }" class="fixed top-0 right-0 left-0 z-10 bg-white dark:bg-secondary-800 border-b border-secondary-100 dark:border-secondary-700">
    <div class="px-4 md:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <button @click="open = ! open"
                        class="md:hidden me-2 inline-flex items-center justify-center p-2
                        rounded-md text-txtdark-400 dark:text-txtdark-500 hover:text-txtdark-500
                        dark:hover:text-txtdark-400 hover:bg-secondary-100 dark:hover:bg-secondary-900
                        focus:outline-none focus:bg-secondary-100 dark:focus:bg-secondary-900
                        focus:text-txtdark-500 dark:focus:text-txtdark-400 transition duration-150 ease-in-out">
                        <i class="fa-solid fa-bars"></i>
                    </button>
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
                <x-dropdown align="right" width="48" class="inline-flex items-center px-2 pt-1 border-b-2 border-transparent
                    text-sm font-medium leading-5 text-txtdark-500 dark:text-txtdark-400 hover:text-txtdark-700
                    dark:hover:text-txtdark-300 hover:border-secondary-300 dark:hover:border-secondary-700 focus:outline-none
                    focus:text-txtdark-700 dark:focus:text-txtdark-300 focus:border-secondary-300 dark:focus:border-secondary-700
                    active:border-primary-400 dark:active:border-primary-600
                    transition duration-150 ease-in-out">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-txtdark-500 dark:text-txtdark-400 bg-white dark:bg-secondary-800 hover:text-txtdark-700 dark:hover:text-txtdark-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->first_name }}</div>
                            <div class="ml-1 text-xs">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:block fixed h-screen w-60 overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] dark:bg-secondary-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex flex-row">
                <div class="basis-6">
                    <i class="fa-solid fa-gauge-high"></i>
                </div>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-secondary-200 dark:border-secondary-600">
            <div class="mt-3 space-y-1">
                @can('user_index')
                <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span>{{ __('Users') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('document_type_index')
                <x-responsive-nav-link :href="route('document_types')" :active="request()->routeIs('document_types')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <span>{{ __('Document Types') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('country_index')
                <x-responsive-nav-link :href="route('countries')" :active="request()->routeIs('countries')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-earth-americas"></i>
                    </div>
                    <span>{{ __('Countries') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('state_index')
                <x-responsive-nav-link :href="route('states')" :active="request()->routeIs('states')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <span>{{ __('States') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('city_index')
                <x-responsive-nav-link :href="route('cities')" :active="request()->routeIs('cities')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-city"></i>
                    </div>
                    <span>{{ __('Cities') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('currency_index')
                <x-responsive-nav-link :href="route('currencies')" :active="request()->routeIs('currencies')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-money-bill-wave"></i>
                    </div>
                    <span>{{ __('Currencies') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('role_index')
                <x-responsive-nav-link :href="route('roles')" :active="request()->routeIs('roles')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <span>{{ __('Roles') }}</span>
                </x-responsive-nav-link>
                @endcan
                <x-responsive-nav-link :href="route('profiles')" :active="request()->routeIs('profiles')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>