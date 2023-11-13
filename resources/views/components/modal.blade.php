<div x-data="{ open: true }" x-show="open" @keydown.escape.window="open = false" x-cloak class="fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <div x-show="open" class="fixed inset-0 bg-secondary-800 bg-opacity-50 transition-opacity"></div>
        <div x-show="open"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white max-h-[90vh] overflow-y-auto p-8">
                <h3 class="text-lg leading-6 font-medium text-txtdark-900">
                    <!-- Título del modal -->
                    {{ $title }}
                </h3>
                <div class="mt-2">
                    <!-- Contenido del modal -->
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>