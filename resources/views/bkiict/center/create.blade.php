<x-app-layout>
    @section('title', 'Add new center')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('bkiict.center.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="center_name" :value="__('Center name')" />
                            <x-text-input id="center_name" name="center_name" type="text" class="mt-1 block w-full" :value="old('center_name')" required autocomplete="center_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('center_name')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option value="1" @selected(in_array(old('status'), ['1']))>Active</option>
                                <option value="0" @selected(in_array(old('status'), ['0']))>Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
