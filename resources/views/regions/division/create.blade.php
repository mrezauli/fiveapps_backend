<x-app-layout>
    @section('title', 'Add new Division')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new Division') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ url()->current() }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name_en" :value="__('Name (en)')" />
                            <x-text-input id="name_en" name="name_en" type="text" class="mt-1 block w-full" :value="old('name_en')" required autofocus autocomplete="name_en" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_en')" />
                        </div>
                        <div>
                            <x-input-label for="name_bn" :value="__('Name (bn)')" />
                            <x-text-input id="name_bn" name="name_bn" type="text" class="mt-1 block w-full" :value="old('name_bn')" required autofocus autocomplete="name_bn" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_bn')" />
                        </div>
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
