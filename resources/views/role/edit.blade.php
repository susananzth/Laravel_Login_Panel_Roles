<x-modal title="{{ __('Edit Role') }}" wire:model="updateRol" focusable>
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
                value="{{ $title }}" wire:model="title"
                required autofocus autocomplete="off" />
            <x-input.message-error class="mt-2" :messages="$errors->get('title')" />
        </div>
        <div>
            <x-input.label for="status">{{ __('Status') }} *</x-input.label>
            <x-input.select id="status" class="block mt-1 w-full" 
                name="status" wire:model="status" required>
                <option value="">{{ __('Please select') }}</option>
                <option value="false" {{ ($status == false) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                <option value="true" {{ ($status == true) ? 'selected' : '' }}>{{ __('Active') }}</option>
            </x-input.select>
            <x-input.message-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <x-tab class="col-span-2">
            <x-slot name="trigger">
                <x-tab-link href="first">
                    {{ __('Permissions') }}
                </x-tab-link>
                <x-tab-link href="second">
                    {{ __('Users') }}
                </x-tab-link>
            </x-slot>

            <x-slot name="content">
                <div id="first" x-show="activeTab === 'first'" class="p-4" x-transition:enter.duration.100ms>
                    <div x-data="{ openMenus: [] }">
                        @foreach($permissions as $item)
                        @php
                            $itemMenu = is_object($item) ? $item->menu : $item['menu'];
                            $itemPermissions = is_object($item) ? $item->permissions : $item['permissions'];
                            $count = 0;
                            foreach ($itemPermissions as $item) {
                                !in_array($item->id, $selectedPermissions) ?: $count++;
                            }
                        @endphp
                        <div class="border" x-data="{ count: {{ $count }} }">
                            <button type="button"
                                x-on:click="openMenus.includes('{{ $itemMenu }}') ? openMenus = openMenus.filter(item => item !== '{{ $itemMenu }}') : openMenus.push('{{ $itemMenu }}')"
                                class="flex flex-row w-full text-left px-4 py-2 bg-secondary-200">
                                <span class="flex-auto">{{ __($itemMenu) }}</span>
                                <span class="px-2 text-sm text-slate-500">
                                    (<span class="text-slate-600" x-text="count"></span>/{{ count($itemPermissions) }})
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
                <div id="second" x-show="activeTab === 'second'" class="p-4" x-transition:enter.duration.100ms>
                    <div class="rounded overflow-x-auto">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b bg-secondary-800 font-medium text-white">
                                <tr>
                                    <x-table.th title="{{ __('Name') }}" />
                                    <th scope="col" class="px-6 py-4">{{ __('Email') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-secondary-100">
                                    <x-table.td>{{ $item->first_name }} {{ $item->last_name }}</x-table.td>
                                    <x-table.td>{{ $item->email }}</x-table.td>
                                </tr>
                                @empty
                                <x-table.empty colspan="2" />
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-slot>
        </x-tab>

        <div class="flex justify-end gap-4">
            <x-button.primary type="button" wire:click.prevent="update()">
                <i class="fa-solid fa-save me-1"></i>{{ __('Update') }}
            </x-button.primary>
            <x-button.secondary wire:click.prevent="cancel()">
                <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
            </x-button.secondary>
        </div>
    </form>
</x-modal>