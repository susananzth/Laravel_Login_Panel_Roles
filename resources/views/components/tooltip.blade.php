@props([
    'content' => 'Tooltip',
    'position' => '-top-3'
])
<span {{ $attributes->merge(['class' => '
    relative
    before:content-[attr(data-content)]
    before:absolute
    before:px-3 before:py-2
    before:left-1/2 before:-top-3
    before:w-max before:max-w-xs
    before:-translate-x-1/2 before:-translate-y-full
    before:bg-secondary-700 before:text-white
    before:rounded-md before:opacity-0
    before:transition-all

    after:absolute
    after:left-1/2 after:-top-3
    after:h-0 after:w-0
    after:-translate-x-1/2 after:border-0
    after:border-t-secondary-700
    after:border-l-transparent
    after:border-b-transparent
    after:border-r-transparent
    after:opacity-0
    after:transition-all

    hover:before:opacity-100  hover:after:opacity-100
']) }} data-content="{{ $content }}">
    {{ $slot }}
</span>