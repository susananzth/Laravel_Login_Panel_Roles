<div class="accordion">
    @foreach ($items as $index => $item)
        <div class="accordion-item">
            <h2 class="accordion-header cursor-pointer" wire:click="toggleItem({{ $index }})">
                {{ $item['title'] }}
            </h2>
            @if ($openItem === $index)
                <div class="accordion-content">
                    {{ $item['content'] }}
                </div>
            @endif
        </div>
    @endforeach
</div>
