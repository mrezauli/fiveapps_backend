<x-app-layout>
    @section('title', 'Import Result Data')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Result Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ url()->current() }}" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="file" :value="__('Select a data file (.csv)')" />
                            <x-text-input id="file" name="file" type="file" class="mt-1 block w-full p-2 border" accept="text/csv" :value="old('file')" required autocomplete="file" />
                            <x-input-error class="mt-2" :messages="$errors->get('file')" />
                        </div>
                        <div>
                            <x-input-label for="exam_type" :value="__('Exam Type')" />
                            <x-select id="exam_type" name="exam_type" class="mt-1 block w-full" required>
                                <option value="">Select Exam Type</option>
                                <option value="fe" @selected(old_with('exam_type', 'fe'))>FE</option>
                                <option value="ip" @selected(old_with('exam_type', 'ip'))>IP</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('exam_type')" />
                        </div>
                        <x-primary-button>{{ __('Import') }}</x-primary-button>
                    </form>
                </div>
                @if (session()->get('array'))
                    <div class="space-y-2 text-sm p-6">
                        <h2 class="font-bold text-xl mb-3">Importing result data</h2>
                        <p>Unpacking CSV file...</p>
                        <p>Processing CSV file...</p>
                        <p>Total data found - <b>{{ count(session()->get('array')['total']) }}</b></p>
                        <p>Total data imported - <b>{{ count(session()->get('array')['imported']) }}</b></p>
                        <p>Duplicate data found <i>(Not imported)</i> - <b>{{ count(session()->get('array')['duplicate']) }}</b></p>
                        <p>Skipped data(s) for wrong format or error(s) - <b>{{ count(session()->get('array')['skipped']) }}</b></p>
                        <p>Error in Entries - <b>{{ count(session()->get('array')['entryError']) }}</b></p>
                        @if (count(session()->get('array')['entryError']) > 0)
                            <p class="text-red-500 font-bold">Errors:</p>
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Data Row</th>
                                        <th class="py-3 px-6 text-left">Error</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach (session()->get('array')['entryError'] as $error)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ implode('|', $error['data']) }}</td>
                                            <td class="py-3 px-6 text-left">{{ $error['message'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <p class="font-bold text-blue-500">{{ session()->get('array')['message'] }}</p>
                        <a class="text-indigo-600 underline hover:text-indigo-900 block mt-6" href="{{ route('itee.results.import') }}">Import another file</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
