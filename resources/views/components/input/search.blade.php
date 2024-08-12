<x-input.text id="search" class="block w-full mb-1" type="text"
    name="search" wire:model="search" placeholder="{{ __('Search') }}" 
    x-on:input="$dispatch('search-input', { value: $event.target.value})"
    autocomplete="off" maxlength="150" required />
<x-input.message-error :messages="$errors->get('search')" class="mt-2" />