<x-app-layout>
    @section('title', 'Add new exam fee')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new exam fee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.exam-fee.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="exam_name" :value="__('Exam name')" />
                            <x-text-input id="exam_name" step="0.01" name="exam_name" type="text" class="mt-1 block w-full" :value="old('exam_name')" required autocomplete="exam_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('exam_name')" />
                        </div>
                        <div>
                            <x-input-label for="exam_type_id" :value="__('Exam Type')" />
                            <x-select id="exam_type_id" name="exam_type_id" class="mt-1 block w-full" required>
                                <option value="">Select Exam Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @checked(old('exam_type_id') && old('exam_type_id') == $type->id ? true : false)>{{ $type->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('exam_type_id')" />
                        </div>
                        <div>
                            <x-input-label for="category_id" :value="__('Exam Category')" />
                            <x-select id="category_id" name="category_id" class="mt-1 block w-full" required>
                                <option value="">Select Exam Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @checked(old('category_id') && old('category_id') == $category->id ? true : false)>{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>
                        <div>
                            <x-input-label for="exam_fee" :value="__('Fee (in taka)')" />
                            <x-text-input id="exam_fee" step="0.01" name="exam_fee" type="number" class="mt-1 block w-full" :value="old('exam_fee')" required autocomplete="exam_fee" />
                            <x-input-error class="mt-2" :messages="$errors->get('exam_fee')" />
                        </div>
                        <div>
                            <x-input-label for="exam_details" :value="__('Exam details')" />
                            <x-textarea rows="8" id="exam_details" name="exam_details" class="mt-1 block w-full" :value="old('exam_details')" required autocomplete="exam_details">{{ old('exam_details') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('exam_details')" />
                        </div>
                        <div>
                            <x-input-label for="exam_start" :value="__('Exam Start Date and Time')" />
                            <x-text-input id="exam_start" name="exam_start" type="datetime-local" class="block w-full" :value="old('exam_start')" required autocomplete="exam_start" />
                            <x-input-error class="mt-2" :messages="$errors->get('exam_start')" />
                        </div>
                        <div>
                            <x-input-label for="exam_end" :value="__('Exam End Date and Time')" />
                            <x-text-input id="exam_end" name="exam_end" type="datetime-local" class="block w-full" :value="old('exam_end')" required autocomplete="exam_end" />
                            <x-input-error class="mt-2" :messages="$errors->get('exam_end')" />
                        </div>
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
