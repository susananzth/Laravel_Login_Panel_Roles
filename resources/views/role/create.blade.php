<x-modal title="{{ _('Create new role') }}" wire:model="addRol" focusable>
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
                @foreach ($permissions as $permission)
                    <li>
                        <label>
                            <input type="checkbox" wire:model="permissions.{{ $permission->id }}">
                            {{ $permission->menu }} - {{ $permission->permission }}
                        </label>
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