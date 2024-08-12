@props(['href'])

<button x-on:click="activeTab = '{{ $href }}'" type="button" 
    :class="{ 'border-b-tab underline': activeTab === '{{ $href }}' }"
    {{ $attributes->merge(['class' => 'bg-white rounded-t-lg border -mb-px px-4 py-2 focus:outline-none']) }}>
    {{ $slot }}
</button>

