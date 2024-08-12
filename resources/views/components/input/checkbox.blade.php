@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} type="checkbox" {!! $attributes->merge(['class' => '
    rounded dark:bg-secondary-900 border-secondary-300 dark:border-secondary-700 text-primary-600 shadow-sm 
    focus:ring-primary-500 dark:focus:ring-primary-600 dark:focus:ring-offset-secondary-800']) !!}>