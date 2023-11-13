@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-terciary-400 dark:border-terciary-600 text-left text-base font-medium text-terciary-700 dark:text-terciary-300 bg-terciary-50 dark:bg-terciary-900/50 focus:outline-none focus:text-terciary-800 dark:focus:text-terciary-200 focus:bg-terciary-100 dark:focus:bg-terciary-900 focus:border-terciary-700 dark:focus:border-terciary-300 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-txtdark-600 dark:text-txtdark-400 hover:text-txtdark-800 dark:hover:text-txtdark-200 hover:bg-secondary-50 dark:hover:bg-secondary-700 hover:border-secondary-300 dark:hover:border-secondary-600 focus:outline-none focus:text-txtdark-800 dark:focus:text-txtdark-200 focus:bg-secondary-50 dark:focus:bg-secondary-700 focus:border-secondary-300 dark:focus:border-secondary-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>