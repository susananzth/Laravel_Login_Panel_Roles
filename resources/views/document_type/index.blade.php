<x-slot name="header">
    <x-title-list icon="id-card">{{ __('Document Types') }}</x-title-list>
</x-slot>

<div class="max-w-7xl py-6 mx-auto sm:px-4 lg:px-6 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-secondary-800 shadow sm:rounded-lg">
        <x-session-status/>
        <div class="flex flex-col">
            <div class="inline-block min-w-full">
                <x-primary-button type="button" wire:click="create()" class="mb-2">
                    <i class="fa-solid fa-plus me-1"></i>{{ __('Create Document Type') }}
                </x-primary-button>
                <div class="rounded overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-secondary-800 font-medium text-white dark:border-secondary-500 dark:bg-secondary-900">
                            <tr>
                                <x-table-th title="{{ __('Name') }}" />
                                <x-table-th title="{{ __('Created at') }}" />
                                <x-table-th title="{{ __('Updated at') }}" />
                                <x-table-th title="{{ __('Status') }}" />
                                <th scope="col" class="px-6 py-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($document_types as $document_type)
                            <tr
                                class="border-b transition duration-300 ease-in-out hover:bg-secondary-100 dark:border-secondary-500 dark:hover:bg-secondary-600">
                                <x-table-td>{{ $document_type->name }}</x-table-td>
                                <x-table-td>{{ Carbon\Carbon::parse($document_type->created_at)->format('d/m/Y h:m:s') }}</x-table-td>
                                <x-table-td>{{ Carbon\Carbon::parse($document_type->updated_at)->format('d/m/Y h:m:s') }}</x-table-td>
                                <x-table-td>
                                    @if ($document_type->status == true)
                                    <x-bag color="bg-emerald-400">{{ __('Active') }}</x-bag>
                                    @else
                                    <x-bag color="bg-red-400">{{ __('Inactive') }}</x-bag>
                                    @endif
                                </x-table-td>
                                <x-table-td>
                                    <x-table-buttons id="{{ $document_type->id }}" />
                                </x-table-td>
                            </tr>
                            @empty
                            <x-table-empty />
                            @endforelse
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
            <x-table-modal-delete model="deleteDocumentType" />
        @endif
    </div>
</div>