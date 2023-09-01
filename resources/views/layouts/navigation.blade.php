<nav x-data="{ open: false }" class="fixed top-0 right-0 left-0 z-10 bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700">
    <div class="px-4 md:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <button @click="open = ! open"
                        class="md:hidden me-2 inline-flex items-center justify-center p-2
                        rounded-md text-slate-400 dark:text-slate-500 hover:text-slate-500
                        dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900
                        focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900
                        focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <a href="{{ '/' }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-slate-800 dark:text-slate-200" />
                        <span class="font-medium dark:text-neutral-200 px-2">Susananzth</span>
                    </a>
                </div>
            </div>
            <div class="flex">
                @if(count(config('app.languages')) > 1)
                <x-dropdown align="right" width="48" class="inline-flex items-center px-2 pt-1 border-b-2 border-transparent
                    text-sm font-medium leading-5 text-slate-500 dark:text-slate-400 hover:text-slate-700
                    dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-700 focus:outline-none
                    focus:text-slate-700 dark:focus:text-slate-300 focus:border-slate-300 dark:focus:border-slate-700
                    active:border-pink-400 dark:active:border-pink-600
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
                    text-sm font-medium leading-5 text-slate-500 dark:text-slate-400 hover:text-slate-700
                    dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-700 focus:outline-none
                    focus:text-slate-700 dark:focus:text-slate-300 focus:border-slate-300 dark:focus:border-slate-700
                    active:border-pink-400 dark:active:border-pink-600
                    transition duration-150 ease-in-out">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
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
    <div :class="{'block': open, 'hidden': ! open}" class="md:block fixed h-screen w-60 overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] dark:bg-zinc-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex flex-row">
                <div class="basis-6">
                    <i class="fa-solid fa-gauge-high"></i>
                </div>
                <span>{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-slate-200 dark:border-slate-600">
            <div class="mt-3 space-y-1">
                @can('user_index')
                <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('user.index')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span>{{ __('Users') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('country_index')
                <x-responsive-nav-link :href="route('countries')" :active="request()->routeIs('country.index')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-earth-americas"></i>
                    </div>
                    <span>{{ __('Countries') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('state_index')
                <x-responsive-nav-link :href="route('states')" :active="request()->routeIs('state.index')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <span>{{ __('States') }}</span>
                </x-responsive-nav-link>
                @endcan
                @can('role_index')
                <x-responsive-nav-link :href="route('roles')" :active="request()->routeIs('role.index')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <span>{{ __('Roles') }}</span>
                </x-responsive-nav-link>
                @endcan
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="flex flex-row">
                    <div class="basis-6">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <span>{{ __('Profile') }}</span>
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
