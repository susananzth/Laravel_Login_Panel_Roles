@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
    border-secondary-300 dark:border-secondary-700 dark:bg-secondary-900 dark:text-txtdark-300 focus:border-primary-500
    dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-md shadow-sm']) !!}>