@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'border-slate-300 dark:border-slate-700 
    dark:bg-slate-900 dark:text-slate-300 focus:border-pink-500
    dark:focus:border-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600 
    rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>
