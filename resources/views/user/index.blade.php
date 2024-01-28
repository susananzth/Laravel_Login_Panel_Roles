<x-slot name="header">
    <x-title-list icon="users">{{ __('Users') }}</x-title-list>
</x-slot>

<div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
        <x-session-status/>
        <div class="flex flex-col">
            <div class="inline-block min-w-full">
                <x-primary-button type="button" wire:click="create()" class="mb-2">
                    <i class="fa-solid fa-plus me-1"></i>{{ __('Create User') }}
                </x-primary-button>
                <div class="rounded overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-secondary-800 font-medium text-white dark:border-secondary-500 dark:bg-secondary-900">
                            <tr>
                                <x-table-th title="{{ __('First name') }}" />
                                <x-table-th title="{{ __('Last name') }}" />
                                <x-table-th title="{{ __('Email') }}" />
                                <x-table-th title="{{ __('Updated at') }}" />
                                <x-table-th title="{{ __('Status') }}" />
                                <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-secondary-100 dark:border-secondary-500 dark:hover:bg-secondary-600">
                                <x-table-td>{{ $user->first_name }}</x-table-td>
                                <x-table-td>{{ $user->last_name }}</x-table-td>
                                <x-table-td>{{ $user->email }}</x-table-td>
                                <x-table-td>{{ Carbon\Carbon::parse($user->updated_at)->format('d/m/Y h:m:s') }}</x-table-td>
                                <x-table-td>
                                    @if ($user->status == true)
                                    <x-bag color="bg-emerald-400">{{ __('Active') }}</x-bag>
                                    @else
                                    <x-bag color="bg-red-400">{{ __('Inactive') }}</x-bag>
                                    @endif
                                </x-table-td>
                                <x-table-td>
                                    <x-table-buttons id="{{ $user->id }}" />
                                </x-table-td>
                            </tr>
                            @empty
                            <x-table-empty colspan="6" />
                            @endforelse
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
            <x-table-modal-delete model="deleteUser" />
        @endif
    </div>
</div>