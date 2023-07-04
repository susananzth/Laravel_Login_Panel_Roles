<x-modal title="{{ _('Create new role') }}" wire:model="addRol" focusable wire:initial-data="{ 'activeItem': $activeItem }">
    <form class="mt-6 space-y-6">
        @method('patch')
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text"
                class="mt-1 block w-full" maxlength="150"
                wire:model="title"
                required autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>
        <div>
            <h4>{{ __('Permissions') }}</h4>
            <ul>
                @foreach ($permissions as $index => $item)
                    <li>
                        <h5 x-on:click="toggle({{ $index }})"
                            class="w-full flex justify-between items-center py-2 px-4 bg-gray-200 
                            cursor-pointer font-semibold text-lg text-slate-800 dark:text-slate-200 leading-tight">
                            <input type="checkbox" wire:model="menu.{{ $item->menu }}">
                            {{ __($item->menu) }}
                            <span x-bind:class="{ 'transform rotate-180': {{ $activeItem }} === {{ $index }} }" class="transition-transform duration-300 ease-in-out">
                                &#9650;
                            </span>
                        </h5>
                        <ul x-show="{{ $activeItem }} === {{ $index }}" class="px-4 py-2 bg-white">
                            @foreach ($item->permissions as $child)
                                <li class="text-slate-800 dark:text-slate-200 leading-tight">
                                    <input type="checkbox" wire:model="permissions.{{ $child->id }}">
                                    {{ __($child->permission) }}
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex justify-end gap-4">
            <x-primary-button type="button" wire:click.prevent="store()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Save') }}
            </x-primary-button>
            <x-secondary-button wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>