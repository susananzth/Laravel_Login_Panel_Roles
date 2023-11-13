@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2 pt-1 border-b-2 border-primary-400 dark:border-primary-600
                text-sm font-medium leading-5 text-txtdark-900 dark:text-txtdark-100 focus:outline-none
                focus:border-primary-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-2 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-txtdark-500 dark:text-txtdark-400 hover:text-txtdark-700 dark:hover:text-txtdark-300 hover:border-secondary-300 dark:hover:border-secondary-700 focus:outline-none focus:text-txtdark-700 dark:focus:text-txtdark-300 focus:border-secondary-300 dark:focus:border-secondary-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>