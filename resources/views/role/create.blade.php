<x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
        {{ __('Create Rol') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-slate-800 shadow sm:rounded-lg">
            <x-validation-errors/>
            <div class="max-w-xl">
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
                            wire:model="title" :value="old('title', $role->title)"
                            required autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button type="button" wire:click.prevent="store()">
                            {{ __('Save') }}
                        </x-primary-button>
                        <x-secondary-button wire:click.prevent="cancel()">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
