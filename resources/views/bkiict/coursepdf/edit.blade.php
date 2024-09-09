<x-app-layout>
    @section('title', 'Edit pdf')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit pdf') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('bkiict.course_pdf.store') }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $pdf->id }}">
                        <div>
                            <x-input-label for="name" :value="__('Course PDF name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $pdf->name)" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="relative">
                            <x-input-label for="file" :value="__('PDF file')" />
                            <a href="{{ asset($pdf->file) }}" target="_blank" class="absolute left-[calc(100%+6px)] bottom-0 flex justify-center items-center gap-1 text-indigo-600 hover:text-indigo-900 py-[14px] px-4 transition-colors bg-indigo-100 hover:bg-indigo-300 rounded-md"><span class="text-sm block">Preview</span> <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i></a>
                            <x-text-input id="file" name="file" type="file" class="mt-1 block w-full p-2 border" accept="application/pdf" :value="old('file')" autocomplete="file" />
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option value="1" @selected(in_array(old('status', $pdf->status), ['1']))>Active</option>
                                <option value="0" @selected(in_array(old('status', $pdf->status), ['0']))>Inactive</option>
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
