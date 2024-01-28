@props(['model' => ''])

<x-modal wire:model="{{ $model }}" focusable
    :title="__('Are you sure you want to delete the record?')">

    <p class="mt-1 text-sm text-txtdark-600">
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