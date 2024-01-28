<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-txtdark-900 dark:text-txtdark-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-txtdark-600 dark:text-txtdark-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <i class="fa-solid fa-trash me-1"></i>{{ __('Delete Account') }}
    </x-danger-button>

    <x-modal-alpi name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable
        :title="__('Are you sure you want to delete your account?')" :maxWidth="'md'">
        <form method="post">
            @csrf
            @method('delete')

            <p class="mt-1 text-sm text-txtdark-600 dark:text-txtdark-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password_delete">{{ __('Password') }}</x-input-label>
                <x-text-input id="password_delete" class="block mt-1 w-full"
                    type="password" name="password_delete" wire:model="password_delete"
                    autocomplete="off" maxlength="255" required />
                <x-input-error :messages="$errors->get('password_delete')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    <i class="fa-solid fa-ban me-1"></i>{{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button  type="button" wire:click.prevent="delete()" class="ml-3">
                    <i class="fa-solid fa-trash me-1"></i>{{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal-alpi>
</section>