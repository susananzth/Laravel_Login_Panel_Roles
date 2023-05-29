<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-slate-800 shadow sm:rounded-lg">
                <x-validation-errors/>
                <div class="flex flex-col">
                    <div class="inline-block min-w-full">
                        <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b bg-slate-800 font-medium text-white dark:border-slate-500 dark:bg-slate-900">
                                <tr>
                                    <th scope="col" class="px-6 py-4">ID</th>
                                    <th scope="col" class="px-6 py-4">{{ __('Name') }}</th>
                                    <th scope="col" class="px-6 py-4">{{ __('Created at') }}</th>
                                    <th scope="col" class="px-6 py-4">{{ __('Updated at') }}</th>
                                    <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr
                                    class="border-b transition duration-300 ease-in-out hover:bg-slate-100 dark:border-slate-500 dark:hover:bg-slate-600">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $role->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $role->title }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $role->created_at }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $role->updated_at }}</td>
                                    <td class="whitespace-nowrap text-center px-6 py-4">
                                        <a href="{{ route('role.show', $role->id) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="top" title="@lang('See Role')" class="btn-table btn-show me-1">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('role.edit', $role->id) }}" data-bs-tooltip="tooltip"
                                            data-bs-placement="top" title="@lang('Edit Role')" class="btn-table me-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a href="#" data-id="{{$role->id}}" data-bs-toggle="modal" data-bs-target="#modal_delete"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="@lang('Delete Role')"
                                            class="btn-table btn-delete me-1">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
