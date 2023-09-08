<x-slot name="header">
    <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
        <i class="fa-solid fa-earth-americas me-1"></i>{{ __('Document Types') }}
    </h2>
</x-slot>

<div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-slate-800 shadow sm:rounded-lg">
        <x-session-status/>
        <div class="flex flex-col">
            <div class="inline-block min-w-full">
                <x-primary-button type="button" wire:click="create()" class="mb-2">
                    <i class="fa-solid fa-plus me-1"></i>{{ __('Create Document Type') }}
                </x-primary-button>
                <div class="rounded overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-slate-800 font-medium text-white dark:border-slate-500 dark:bg-slate-900">
                            <tr>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Name') }}</th>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Created at') }}</th>
                                <th scope="col" class="border-r border-slate-700 px-6 py-4">{{ __('Updated at') }}</th>
                                <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($document_types as $document_type)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-slate-100 dark:border-slate-500 dark:hover:bg-slate-600">
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $document_type->name }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $document_type->created_at }}</td>
                                <td class="whitespace-nowrap border-r px-6 py-4">{{ $document_type->updated_at }}</td>
                                <td class="whitespace-nowrap text-center px-6 py-4">
                                    <x-tooltip :content="__('Edit Document Type')">
                                        <a href="#" wire:click="edit({{ $document_type->id }})" class="me-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                    </x-tooltip>
                                    <x-tooltip :content="__('Delete Document Type')">
                                        <a href="#" wire:click="setDeleteId({{ $document_type->id }})">
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
                    {{ $document_types->links() }}
                </div>
            </div>
        </div>
        @if($addDocumentType)
            @include('document_type.create')
        @endif
        @if($updateDocumentType)
            @include('document_type.edit')
        @endif
        @if($deleteDocumentType)
            <x-modal wire:model="deleteDocumentType" focusable
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
