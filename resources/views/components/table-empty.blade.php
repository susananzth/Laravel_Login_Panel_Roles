@props(['colspan' => 4])

<tr
    class="border-b transition duration-300 ease-in-out hover:bg-secondary-100 dark:border-secondary-500 dark:hover:bg-secondary-600">
    <td class="whitespace-nowrap text-center border-r px-6 py-4" colspan="{{ $colspan }}">{{ __('There are no records to show') }}</td>
</tr>