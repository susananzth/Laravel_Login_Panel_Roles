<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form id="form_update" action="{{route('role.update', $role->id)}}" method="post" class="mt-6 space-y-6">
                        @method('patch')
                        @csrf
                        <x-validation-errors/>
                        <p class="italic text-sm text-red-700 m-0">
                            {{ __('Fields marked with * are required') }}
                        </p>

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" 
                                class="mt-1 block w-full" maxlength="150" 
                                :value="old('title', $role->title)" 
                                required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="permission" :value="__('Permissions')" />
                            <x-select-input id="permission" name="permission[]" type="text" 
                                class="mt-1 block w-full" required multiple>
                                @php $name_menu = ""; @endphp
                                @foreach ($permissions as $item)
                                @if ($item->menu != $name_menu)
                                    </optgroup>
                                    <optgroup label="@lang($item->menu)">
                                @endif
                                    <option value="{{$item->id}}">@lang($item->permission . ' ' .$item->menu)</option>
                                @php $name_menu = $item->menu @endphp
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('permission')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <x-secondary-button-link href="{{route('role.index')}}">
                                {{ __('Cancel') }}
                            </x-secondary-button-link>
                
                            @if (session('status') === 'role-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Updated.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

