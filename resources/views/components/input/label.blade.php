@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-txtdark-700 dark:text-txtdark-300']) }}>
    {{ $value ?? $slot }}
</label>
