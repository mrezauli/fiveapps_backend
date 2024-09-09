<x-app-layout>
    @section('title', 'Create new ITEE Syllabus')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new ITEE Syllabus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.syllabus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="syllabus_file" :value="__('Syllabus File')" :exception="__('| (PDF)')" />
                            <x-text-input id="syllabus_file" name="syllabus_file" type="file" class="mt-1 block w-full" accept="application/pdf" required autocomplete="syllabus_file" />
                            <x-input-error class="mt-2" :messages="$errors->get('syllabus_file')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option selected value="">Select Status</option>
                                <option @selected(old('status') == 1) value="1">Active</option>
                                <option  value="0">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <x-primary-button>{{ __('Create') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
