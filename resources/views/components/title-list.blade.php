@props(['icon' => ''])

<h2 class="font-semibold text-xl text-txtdark-800 dark:text-txtdark-200 leading-tight">
    <i class="fa-solid fa-{{ $icon }} me-1"></i>
    {{ $slot }}
</h2>