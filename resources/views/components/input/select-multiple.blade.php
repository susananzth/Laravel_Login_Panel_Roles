@props(['disabled' => false, 'array' => []])

<select id="{{ $attributes->get('id') }}" {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'border-secondary-300 dark:border-secondary-700 
    dark:bg-secondary-900 dark:text-txtdark-300 focus:border-primary-500
    dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 
    rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>

@push('scripts')
<script>
    //const array = @json($array);
    const trans = @json(__('Please select'));
    //const reformattedArray = array.map(({ id, name }) => ({ label: name, value: id }))
    console.log('hola1');
    document.addEventListener('livewire:init', () => {
        Livewire.on('select_init', () => {
            console.log('hola2');
            const selectElement = document.getElementById('{{ $attributes->get('id') }}');
            VirtualSelect.init({
                ele: selectElement,
                multiple: true,
                placeholder: trans,
                //options: reformattedArray,
                search: true
            });

            selectElement.addEventListener('change', function() {
                @this.set('selectedCountries', Array.from(selectElement.selectedOptions).map(option => option.value));
            });
        });
    });
</script>
@endpush