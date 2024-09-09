<x-app-layout>
    @section('title', 'Add new book')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.books.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="book_name" :value="__('Book name')" />
                            <x-text-input id="book_name" name="book_name" type="text" class="mt-1 block w-full" :value="old('book_name')" required autocomplete="book_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('book_name')" />
                        </div>
                        <div>
                            <x-input-label for="book_price" :value="__('Book price (in taka)')" />
                            <x-text-input id="book_price" name="book_price" type="number" class="mt-1 block w-full" :value="old('book_price')" required autocomplete="book_price" />
                            <x-input-error class="mt-2" :messages="$errors->get('book_price')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option value="1" @selected(old('status') && old('status') == 1 ? true : false)>Active</option>
                                <option value="0" @selected(old('status') && old('status') == 0 ? true : false)>Inactive</option>
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
