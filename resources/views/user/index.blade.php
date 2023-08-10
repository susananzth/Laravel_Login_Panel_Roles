<x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
        <i class="fa-solid fa-users me-1"></i>{{ __('Users') }}
    </h2>
</x-slot>

<div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-slate-800 shadow sm:rounded-lg">
        <x-validation-errors/>
        <div class="flex flex-col">
            <div class="inline-block min-w-full">
                <x-primary-button type="button" wire:click="create()" class="mb-2">
                    <i class="fa-solid fa-plus me-1"></i>{{ __('Create User') }}
                </x-primary-button>
                <div class="rounded overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-slate-800 font-medium text-white dark:border-slate-500 dark:bg-slate-900">
                            <tr>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Name') }}</th>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Email') }}</th>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Updated at') }}</th>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Status') }}</th>
                                <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-slate-100 dark:border-slate-500 dark:hover:bg-slate-600">
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $user->name }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $user->email }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ Carbon\Carbon::parse($user->updated_at)->format('d/m/Y h:m:s') }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">
                                    @if ($user->status = true)
                                        <span
                                            class="inline-block whitespace-nowrap rounded-full bg-emerald-400 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-white">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-block whitespace-nowrap rounded-full bg-red-400 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-white">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap text-center px-6 py-4">
                                    <x-tooltip :content="__('Edit User')">
                                        <a href="#" wire:click="edit({{ $user->id }})" class="me-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                    </x-tooltip>
                                    <x-tooltip :content="__('Delete User')">
                                        <a href="#" wire:click="setDeleteId({{ $user->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </x-tooltip>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        @if($addUser)
            @include('user.create')
        @endif
        @if($updateUser)
            @include('user.edit')
        @endif
        @if($deleteUser)
            <x-modal wire:model="deleteUser" focusable
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
