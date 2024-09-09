<x-app-layout>
    @section('title', 'Update event')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.bjet.store') }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $event->id }}">
                        <div>
                            <x-input-label for="label" :value="__('Label')" />
                            <x-text-input id="label" name="label" type="text" class="mt-1 block w-full" :value="old('label', $event->label)" required autocomplete="label" />
                            <x-input-error class="mt-2" :messages="$errors->get('label')" />
                        </div>
                        <div>
                            <x-input-label for="image" :value="__('Select an image (.jpg, .jpeg, .png)')" />
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full p-2 border" accept="image/png, image/jpeg" autocomplete="image" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>
                        <x-input-label for="description" :value="__('Decscription (optional)')" />
                        <div>
                            <x-textarea id="description" name="description" type="text" class="mt-1 block w-full" rows="5" autocomplete="description">{{ old('description', $event->description) }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option value="1" @selected(old_with('status', 1, $event->status))>Active</option>
                                <option value="0" @selected(old_with('status', 0, $event->status))>Inactive</option>
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
