@props(['title' => '', 'field', 'sort', 'direction'])

<th scope="col" wire:click="sortBy('{{ $field }}')" 
    class="cursor-pointer border-r border-secondary-700 px-6 py-4">
    <div class="flex items-center">
        <div class="self-stretch pe-2">{{ $title }}</div>
        @if ($sort === $field)
            @if ($direction === 'asc')
                <i class="fa-solid fa-arrow-up-short-wide"></i>
            @else
                <i class="fa-solid fa-arrow-down-short-wide"></i>
            @endif
        @else
            <i class="fa-solid fa-sort"></i>
        @endif
    </div>
</th>
