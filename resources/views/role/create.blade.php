<x-modal title="{{ __('Create new role') }}" wire:model="addRol" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input.label for="title">{{ __('Title') }} *</x-input.label>
            <x-input.text id="title" name="title" type="text"
                class="mt-1 block w-full" maxlength="150"
                wire:model="title"
                required autofocus autocomplete="off" />
            <x-input.message-error class="mt-2" :messages="$errors->get('title')" />
        </div>
        <div>
            <h4>{{ __('Permissions') }}</h4>
            <div x-data="{ openMenus: [] }">
                @foreach($permissions as $item)
                @php
                    $itemMenu = is_object($item) ? $item->menu : $item['menu'];
                    $itemPermissions = is_object($item) ? $item->permissions : $item['permissions'];
                @endphp
                <div class="border" x-data="{ count: 0 }">
                    <button type="button"
                        x-on:click="openMenus.includes('{{ $itemMenu }}') ? openMenus = openMenus.filter(item => item !== '{{ $itemMenu }}') : openMenus.push('{{ $itemMenu }}')"
                        class="flex flex-row w-full text-left px-4 py-2 bg-secondary-200">
                        <span class="flex-auto">{{ __($itemMenu) }}</span>
                        <span class="px-2 text-sm text-slate-500">
                            (<span class="text-slate-600" x-text="count"></span>/{{count($itemPermissions)}})
                        </span>
                        <i class="fa-solid fa-angle-right text-sm text-slate-600 ms-1 transition-transform transform"
                                    :class="{ 'rotate-90': openMenus.includes('{{ $itemMenu }}') }"></i>
                    </button>
                    <div x-show="openMenus.includes('{{ $itemMenu }}')" class="p-4 space-y-2">
                        @foreach ($itemPermissions as $per)
                        @php
                            $id = is_object($per) ? $per->id : $per['id'];
                            $permissionName = is_object($per) ? $per->permission : $per['permission'];
                        @endphp
                        <div class="flex items-center space-x-2">
                            <x-input.checkbox wire:model="selectedPermissions" 
                                value="{{ $id }}" id="permission-{{ $id }}" 
                                x-on:change="$event.target.checked ? count++ : count--" />
                            <label for="permission-{{ $id }}">{{ __($permissionName) }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <x-button.primary type="button" wire:click.prevent="store()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Save') }}
            </x-button.primary>
            <x-button.secondary wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-button.secondary>
        </div>
    </form>
</x-modal>