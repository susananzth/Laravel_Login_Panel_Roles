@props(['id' => ''])

<a href="#" wire:key="edit-{{ $id }}" wire:click="edit({{ $id }})" class="me-1">
    <i class="fa-solid fa-edit"></i>
</a>
<a href="#" wire:key="delete-{{ $id }}" wire:click="setDeleteId({{ $id }})">
    <i class="fa-solid fa-trash"></i>
</a>