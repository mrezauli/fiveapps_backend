<x-app-layout>
    @section('title', 'Edit Teacher')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Teacher') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('bkiict.teacher.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $teacher->id }}">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $teacher->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email address')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $teacher->email)" required autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Phone number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $teacher->phone)" required autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full" :value="old('designation', $teacher->designation)" required autocomplete="designation" />
                            <x-input-error class="mt-2" :messages="$errors->get('designation')" />
                        </div>


                        <div>
                            <x-input-label for="organization" :value="__('Organization')" />
                            <x-text-input id="organization" name="organization" type="text" class="mt-1 block w-full" :value="old('organization', $teacher->organization)" required autocomplete="organization" />
                            <x-input-error class="mt-2" :messages="$errors->get('organization')" />
                        </div>

                        <div>
                            <x-input-label for="experience" :value="__('Experience')" />
                            <x-text-input id="experience" name="experience" type="text" class="mt-1 block w-full" :value="old('experience', $teacher->experience)" required autocomplete="experience" />
                            <x-input-error class="mt-2" :messages="$errors->get('experience')" />
                        </div>

                        <div>
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png,.gif" class="mt-1 block w-full" :value="old('photo')" autocomplete="photo" />
                            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                        </div>

                        <div>
                            <x-input-label for="work_at" :value="__('Workds at')" />
                            <x-select id="work_at" name="work_at" class="mt-1 block w-full" required>
                                <option value="">Select Work At</option>
                                <option @selected(old('work_at', $teacher->work_at) == 'instructor') value="instructor">Instructor</option>
                                <option @selected(old('work_at', $teacher->work_at) == 'coordinator') value="coordinator">Coordinator</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('work_at')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option @selected((old('status') && old('status') == 'Active' ? true : false) || ($teacher->status == 'Active' ? true : false)) value="Active">Active</option>
                                <option @selected((old('status') && old('status') == 'Inactive' ? true : false) || ($teacher->status == 'Inactive' ? true : false)) value="Inactive">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
