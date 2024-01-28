@props(['color' => 'emerald-400'])

<span
    class="inline-block whitespace-nowrap rounded-full {{ $color }} px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.75em] font-bold leading-none text-white">
    {{ $slot }}
</span>