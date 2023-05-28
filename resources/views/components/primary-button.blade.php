<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-pink-800 dark:bg-pink-200
    border border-transparent rounded-md font-semibold text-xs text-white dark:text-pink-800 uppercase tracking-widest
    hover:bg-pink-700 dark:hover:bg-white focus:bg-pink-700 dark:focus:bg-white active:bg-pink-900 dark:active:bg-pink-300
    focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 dark:focus:ring-offset-pink-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
