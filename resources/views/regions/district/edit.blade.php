<x-app-layout>
    @section('title', 'Edit District')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit District') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit District</p>
                    </div>
                    <a href="{{ route('regions.district.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ url()->current() }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name_en" :value="__('Name (en)')" />
                            <x-text-input id="name_en" name="name_en" type="text" class="mt-1 block w-full" :value="old('name_en', $district->name)" required autofocus autocomplete="name_en" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_en')" />
                        </div>
                        <div>
                            <x-input-label for="name_bn" :value="__('Name (bn)')" />
                            <x-text-input id="name_bn" name="name_bn" type="text" class="mt-1 block w-full" :value="old('name_bn', $district->bn_name)" required autofocus autocomplete="name_bn" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_bn')" />
                        </div>
                        <div>
                            <x-input-label for="division" :value="__('Division')" />
                            <x-select id="division" name="division_id" class="mt-1 block w-full" required>
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" @selected($district->division_id == $division->id)>{{ $division->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('division_id')" />
                        </div>
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
