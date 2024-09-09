<x-app-layout>
    @section('title', 'Create new course')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('bkiict.course.store') }}" method="POST" class="gap-4 grid grid-cols-1 md:grid-cols-2 h-auto items-start">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Course name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="tools" :value="__('Used Tools')" />
                            <x-text-input id="tools" name="tools" type="text" class="mt-1 block w-full" :value="old('tools')" required autocomplete="tools" />
                            <x-input-error class="mt-2" :messages="$errors->get('tools')" />
                        </div>

                        <div>
                            <x-input-label for="requirements" :value="__('Course Requirements')" />
                            <x-textarea id="requirements" name="requirements" type="text" class="mt-1 block w-full" required autocomplete="requirements">{{ old('requirements') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('requirements')" />
                        </div>

                        <div>
                            <x-input-label for="project" :value="__('Course Project')" />
                            <x-textarea id="project" name="project" type="text" class="mt-1 block w-full" required autocomplete="project">{{ old('project') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('project')" />
                        </div>

                        <div>
                            <x-input-label for="overview" :value="__('Course overview')" />
                            <x-textarea id="overview" name="overview" type="text" class="summernote block w-full" required autocomplete="overview">{{ old('overview') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('overview')" />
                        </div>

                        <div>
                            <x-input-label for="outline" :value="__('Course outline')" />
                            <x-textarea id="outline" name="outline" type="text" class="summernote block w-full" required autocomplete="outline">{{ old('outline') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('outline')" />
                        </div>

                        <div>
                            <x-input-label for="center_id" :value="__('Center')" />
                            <x-select id="center_id" name="center_id" class="mt-1 block w-full" required>
                                <option value="">Select Course Center</option>
                                @foreach ($centers as $center)
                                    <option value="{{ $center->id }}" @selected(in_array(old('center_id'), [$center->id]))>{{ $center->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('center_id')" />
                        </div>

                        <div>
                            <x-input-label for="type" :value="__('Course Type')" />
                            <x-select id="type" name="type" class="mt-1 block w-full" required>
                                <option value="">Select Course Type</option>
                                <option value="short" @selected(in_array(old('type'), ['short']))>Short Course</option>
                                <option value="long" @selected(in_array(old('type'), ['long']))>Long Course</option>
                                <option value="customized" @selected(in_array(old('type'), ['customized']))>Customized Course</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-input-label for="duration" :value="__('Course duration')" />
                            <x-text-input id="duration" name="duration" type="text" class="block w-full" :value="old('duration')" required autocomplete="duration" />
                            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                        </div>

                        <div>
                            <x-input-label for="hours" :value="__('Course hour(s)')" />
                            <x-text-input id="hours" name="hours" type="number" class="block w-full" :value="old('hours')" required autocomplete="hours" />
                            <x-input-error class="mt-2" :messages="$errors->get('hours')" />
                        </div>

                        <div>
                            <x-input-label for="classes" :value="__('Classes')" />
                            <x-text-input id="classes" name="classes" type="number" class="block w-full" :value="old('classes')" required autocomplete="classes" />
                            <x-input-error class="mt-2" :messages="$errors->get('classes')" />
                        </div>
                        <div>
                            <x-input-label for="fee" :value="__('Course Fee (in taka)')" />
                            <x-text-input id="fee" name="fee" type="text" class="block w-full" :value="old('fee')" required autocomplete="fee" />
                            <x-input-error class="mt-2" :messages="$errors->get('fee')" />
                        </div>
                        <div>
                            <x-input-label for="shift" :value="__('Class Shift')" />
                            <x-text-input id="shift" name="shift" type="text" class="block w-full" :value="old('shift')" required autocomplete="shift" />
                            <x-input-error class="mt-2" :messages="$errors->get('shift')" />
                        </div>


                        {{-- <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="block w-full" required>
                                <option value="">Select Status</option>
                                <option value="ongoing" @selected(in_array(old('status'), ['ongoing']))>Ongoing</option>
                                <option value="upcoming" @selected(in_array(old('status'), ['upcoming']))>Upcoming</option>
                                <option value="deactive" @selected(in_array(old('status'), ['deactive']))>Deactivated</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div> --}}

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option @selected(old('status') == '1') value="1">Active</option>
                                <option @selected(old('status') == '0') value="0">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>


                        <div>
                            <x-input-label for="cordinator" :value="__('Course Cordinator')" />
                            <x-select id="cordinator" name="cordinator" class="block w-full" required>
                                <option value="">Select Course Cordinator</option>
                                @foreach ($cordinators as $cordinator)
                                    <option value="{{ $cordinator->id }}" @selected(in_array(old('cordinator'), [$cordinator->id]))>{{ $cordinator->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('cordinator')" />
                        </div>

                        <div class="flex justify-center items-start flex-col relative h-full">
                            <x-input-label for="instructor" :value="__('Course Instructor')" />
                            <x-select id="instructor" name="instructor[]" multiple="multiple" class="instructor-selector w-full block">
                                @foreach ($instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('instructor')" />
                            <div id="progress" class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-10 hidden justify-center items-center rounded-md z-10">
                                <i class="fa-solid fa-spinner text-indigo-500 animate-spin"></i>
                            </div>
                        </div>



                        <div class="col-span-1 md:col-span-2 flex justify-center items-center mt-3">
                            <x-primary-button class="py-3 !px-12">{{ __('Add') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $('.summernote').summernote({
                minHeight: 200
            });
            $('#instructor').select2({
                placeholder: "Select course instructors",
                width: 'resolve',
            });
        </script>
    @endsection
</x-app-layout>
