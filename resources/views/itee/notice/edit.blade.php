<x-app-layout>
    @section('title', 'Edit ITEE Notice')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit ITEE Notice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit ITEE Notice</p>
                    </div>
                    <a href="{{ route('itee.notice.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.notice.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div>
                            <x-input-label for="notice" :value="__('Notice')" />
                            <textarea name="notice" id="" cols="100" rows="10"> {{ old('notice', $item->notice) }} </textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('notice')" />
                        </div>

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
