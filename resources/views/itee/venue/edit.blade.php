<x-app-layout>
    @section('title', 'Edit ITEE Venue')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ITEE Venue') }}
        </h2>
    </x-slot>
{{-- Test --}}
    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit ITEE Venue</p>
                    </div>
                    <a href="{{ route('itee.venue.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.venue.store') }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $item->name)" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-textarea id="address" name="address" type="text" class="mt-1 block w-full" required autocomplete="address">{{ old('address', $item->address) }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div>
                            <x-input-label for="image" :value="__('Select an image of the location of the venue (.png, .jpg, .jpeg)')" />
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full p-2 border" accept="image/png,image/jpg,image/jpeg" :value="old('image')" autocomplete="image" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        @if ($item->photo)
                            <div class="text-center">
                                <div class="text-center rounded p-1 border border-slate-300 inline-block">
                                    <div class="rounded overflow-hidden">
                                        <img src="{{ asset($item->photo) }}" class="rounded {{-- hover:scale-110 --}} pointer-events-none select-none transition-transform" alt="{{ $item->name }}">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option @selected(old('status', $item->status) == 1) value="1">Active</option>
                                <option @selected(old('status', $item->status) == 0) value="0">Inactive</option>
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
