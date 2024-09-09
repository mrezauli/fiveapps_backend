<x-app-layout>
    @section('title', 'Create new Batch')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new Batch') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('bkiict.batch.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Batch Name')" />
                            <x-text-input id="name" name="name" type="text" placeholder="Enter Batch Name" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="number" :value="__('Batch Number')" />
                            <x-text-input id="number" name="number" type="number" placeholder="Enter Batch Number" class="mt-1 block w-full" :value="old('number')" required autocomplete="number" />
                            <x-input-error class="mt-2" :messages="$errors->get('number')" />
                        </div>

                        <div>
                            <x-input-label for="deadline" :value="__('Reg Deadline')" />
                            <x-text-input id="deadline" name="deadline" type="date" class="block w-full" :value="old('deadline')" required autocomplete="deadline" />
                            <x-input-error class="mt-2" :messages="$errors->get('deadline')" />
                        </div>

                        <div>
                            <x-input-label for="class_start" :value="__('Class Start')" />
                            <x-text-input id="class_start" name="class_start" type="date" class="block w-full" :value="old('class_start')" required autocomplete="class_start" />
                            <x-input-error class="mt-2" :messages="$errors->get('class_start')" />
                        </div>

                        <div>
                            <x-input-label for="bkiict_course_id" :value="__('Select Course')" />
                            <x-select id="bkiict_course_id" name="bkiict_course_id" class="mt-1 block w-full" required>
                                <option value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option @selected(in_array(old('bkiict_course_id'), [$course->id])) value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('bkiict_course_id')" />
                        </div>

                        <div>
                            <x-input-label for="course_end" :value="__('Course End')" />
                            <x-text-input id="course_end" name="course_end" type="date" class="block w-full" :value="old('course_end')" required autocomplete="course_end" />
                            <x-input-error class="mt-2" :messages="$errors->get('course_end')" />
                        </div>

                        {{-- <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option @selected(old('status') == '1') value="1">Active</option>
                                <option @selected(old('status') == '0') value="0">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div> --}}
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="block w-full" required>
                                <option value="">Select Status</option>
                                <option value="ongoing" @selected(in_array(old('status'), ['ongoing']))>Ongoing</option>
                                <option value="upcoming" @selected(in_array(old('status'), ['upcoming']))>Upcoming</option>
                                <option value="deactive" @selected(in_array(old('status'), ['deactive']))>Deactivated</option>
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
