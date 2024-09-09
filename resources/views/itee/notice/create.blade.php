<x-app-layout>
    @section('title', 'Create new ITEE Notice')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new ITEE Notice') }}
        </h2>
    </x-slot>

    {{-- error message --}}

    <div class="py-12">
        @if ($block)
            <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8 pb-2">
                <div class="bg-[#FFF1D2] text-gray-700 p-4 mb-4 rounded border-l-4 border-[#FDB81E] shadow-sm">
                    <p class="font-bold text-lg">Warning!</p>
                    <p class="text-[15px]">It seems like you have already created three notice. You are allowed to create max 3 notice. Please delete any existing one to create a new one.</p>
                </div>
            </div>
        @endif
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ $block ? '#' : route('itee.notice.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="notice" :value="__('Notice')" />
                            <x-textarea name="notice" id="" cols="100" rows="10"> {{ old('notice') }} </x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('notice')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option selected value="">Select Status</option>
                                <option @selected(old('status') == 1) value="1">Active</option>
                                <option value="0">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <x-primary-button :disabled="$block">{{ __('Create') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
