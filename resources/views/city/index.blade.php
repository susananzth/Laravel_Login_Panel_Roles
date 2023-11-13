<x-slot name="header">
    <h2 class="font-semibold text-xl text-txtdark-800 dark:text-txtdark-200 leading-tight">
        <i class="fa-solid fa-map-location-dot me-1"></i>{{ __('Cities') }}
    </h2>
</x-slot>

<div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
        <x-session-status/>
        <div class="flex flex-col">
            <div class="inline-block min-w-full">
                <x-primary-button type="button" wire:click="create()" class="mb-2">
                    <i class="fa-solid fa-plus me-1"></i>{{ __('Create City') }}
                </x-primary-button>
                <div class="rounded overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-secondary-800 font-medium text-white dark:border-secondary-500 dark:bg-secondary-900">
                            <tr>
                                <th scope="col" class="border-r border-secondary-700 px-6 py-4">{{ __('Name') }}</th>
                                <th scope="col" class="border-r border-secondary-700 px-6 py-4">{{ __('State') }}</th>
                                <th scope="col" class="border-r border-secondary-700 px-6 py-4">{{ __('Country') }}</th>
                                <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-secondary-100 dark:border-secondary-500 dark:hover:bg-secondary-600">
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $city->name }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $city->state->name }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $city->state->country->name }}</td>
                                <td class="whitespace-nowrap text-center px-6 py-4">
                                    <a href="#" wire:click="edit({{ $city->id }})" class="me-1">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="#" wire:click="setDeleteId({{ $city->id }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @if (count($cities) == 0)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-secondary-100 dark:border-secondary-500 dark:hover:bg-secondary-600">
                                <td class="whitespace-nowrap text-center border-r px-6 py-4" colspan="4">{{ __('There are no records to show') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $cities->links() }}
                </div>
            </div>
        </div>
        @if($addCity)
            @include('city.create')
        @endif
        @if($updateCity)
            @include('city.edit')
        @endif
        @if($deleteCity)
            <x-modal wire:model="deleteCity" focusable
                :title="__('Are you sure you want to delete the record?')">

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Once the record is deleted, all data will be permanently erased.') }}
                    </p>

                    <div class="mt-6 flex justify-end gap-4">
                        <x-secondary-button wire:click.prevent="cancel()">
                            <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
                        </x-secondary-button>
                        <x-danger-button type="button" wire:click.prevent="delete()">
                            <i class="fa-solid fa-trash me-1"></i>{{ __('Delete') }}
                        </x-danger-button>
                    </div>
            </x-modal>
        @endif
    </div>
</div>