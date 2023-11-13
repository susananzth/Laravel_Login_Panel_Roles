<x-modal title="{{ __('Edit Role') }}" wire:model="updateRol" focusable>
    <form class="mt-6 space-y-6" method="POST">
        @csrf
        <x-validation-errors/>
        <p class="italic text-sm text-red-700 m-0">
            {{ __('Fields marked with * are required') }}
        </p>

        <div>
            <x-input-label for="title">{{ __('Title') }} *</x-input-label>
            <x-text-input id="title" name="title" type="text"
                class="mt-1 block w-full" maxlength="150"
                value="{{ $title }}" wire:model="title"
                required autofocus autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>
        <div class="col-span-2">
            <x-input-label for="status">{{ __('Status') }} *</x-input-label>
            <x-select-input id="status" class="block mt-1 w-full" 
                name="status" wire:model="status" required>
                <option value="">{{ __('Please select') }}</option>
                <option value="false" {{ ($status == false) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                <option value="true" {{ ($status == true) ? 'selected' : '' }}>{{ __('Active') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
        <div>
            <h4>{{ __('Permissions') }}</h4>
            <div x-data="{ openMenus: [] }">
                @foreach($permissions as $item)
                @php
                    $itemMenu = is_object($item) ? $item->menu : $item['menu'];
                @endphp
                <div class="border">
                    <button type="button"
                        x-on:click="openMenus.includes('{{ $itemMenu }}') ? openMenus = openMenus.filter(item => item !== '{{ $itemMenu }}') : openMenus.push('{{ $itemMenu }}')"
                        class="w-full text-left px-4 py-2 bg-secondary-200">
                        {{ __($itemMenu) }}
                    </button>
                    <div x-show="openMenus.includes('{{ $itemMenu }}')" class="p-4 space-y-2">
                        @php
                            $itemPermissions = is_object($item) ? $item->permissions : $item['permissions'];
                        @endphp
                        @foreach ($itemPermissions as $per)
                        @php
                            $id = is_object($per) ? $per->id : $per['id'];
                            $permissionName = is_object($per) ? $per->permission : $per['permission'];
                        @endphp
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" wire:model="selectedPermissions" value="{{ $id }}" id="permission-{{ $id }}">
                            <label for="permission-{{ $id }}">{{ __($permissionName) }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <x-primary-button type="button" wire:click.prevent="update()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-primary-button>
            <x-secondary-button wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>