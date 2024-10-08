<x-slot name="header">
    <x-title-list icon="earth-americas">{{ __('Countries') }}</x-title-list>
</x-slot>

<div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
        <x-session-status/>
        <div class="flex flex-col">
            <div class="inline-block min-w-full">
                <x-button.primary type="button" wire:click="create()" class="mb-2">
                    <i class="fa-solid fa-plus me-1"></i>{{ __('Create Country') }}
                </x-button.primary>
                <div class="rounded overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-secondary-800 font-medium text-white dark:border-secondary-500 dark:bg-secondary-900">
                            <tr>
                                <x-table.th title="{{ __('Name') }}" />
                                <x-table.th title="{{ __('ISO 2') }}" />
                                <x-table.th title="{{ __('ISO 3') }}" />
                                <x-table.th title="{{ __('ISO number') }}" />
                                <x-table.th title="{{ __('Phone code') }}" />
                                <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($countries as $country)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-secondary-100 dark:border-secondary-500 dark:hover:bg-secondary-600">
                                <x-table.td>{{ $country->name }}</x-table.td>
                                <x-table.td>{{ $country->iso_2 }}</x-table.td>
                                <x-table.td>{{ $country->iso_3 }}</x-table.td>
                                <x-table.td>{{ $country->iso_number }}</x-table.td>
                                <x-table.td>{{ $country->phone_code }}</x-table.td>
                                <x-table.td>
                                    <x-table.buttons id="{{ $country->id }}" />
                                </x-table.td>
                            </tr>
                            @empty
                            <x-table.empty colspan="6" />
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $countries->links() }}
                </div>
            </div>
        </div>
        @if($addCountry)
            @include('country.create')
        @endif
        @if($updateCountry)
            @include('country.edit')
        @endif
        @if($deleteCountry)
            <x-table.modal-delete model="deleteCountry" />
        @endif
    </div>
</div>