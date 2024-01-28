@props(['disabled' => false, 'image' => ''])

@php
switch ($image) {
    case '':
        $imagePreview = asset('img/profile.png');
        $text = __('Upload');
        break;
    case gettype($image) != 'string':
        $imagePreview = $image->temporaryUrl();
        $text = __('Modify');
        break;
    default:
        $imagePreview = asset('storage/images/'.$image);
        $text = __('Modify');
        break;
}
@endphp

<div x-data="{ imagePreview: @js($imagePreview) }" class="relative flex">
    <label for="{{ $attributes['id'] }}" class="cursor-pointer block mt-1 w-full 
        inline-flex items-center justify-center px-4 py-2 bg-primary-800 
        border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest
        hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 
        focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <i class="fas fa-upload mr-2"></i>
        {{ $text }}
        <input x-on:change="
            const file = $event.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => { imagePreview = e.target.result; };
            reader.readAsDataURL(file);
        " {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'hidden']) !!}>
    </label>
    <div class="ml-1 flex-auto rounded-md">
        <img :src="imagePreview" class="max-h-2.37" alt="Imagen de portada">
    </div>
</div>