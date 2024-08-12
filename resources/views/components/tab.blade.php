<div x-data="{ activeTab: 'first' }" x-cloak {{ $attributes->merge(['class' => 'rounded-lg border']) }}>
    <div class="flex flex-wrap pt-2 px-1 w-full border-b">
        {{ $trigger }}
    </div>
    {{ $content }}
</div>