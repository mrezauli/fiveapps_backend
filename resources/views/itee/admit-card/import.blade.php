<x-app-layout>
    @section('title', 'Import Admit Card Data')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Admit Card Data') }}
        </h2>
    </x-slot>

    {{-- Show the success message from the session if it exists --}}
    {{-- @if (session()->get('array'))
        @dd(session()->get('array'))
    @endif --}}

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
                        <x-primary-button>{{ __('Import') }}</x-primary-button>
                    </form>
                </div>
                @if (session()->get('array'))
                    <div class="space-y-2 text-sm p-6">
                        <h2 class="font-bold text-xl mb-3">Importing admit card data</h2>
                        <p>Unpacking CSV file...</p>
                        <p>Processing CSV file...</p>
                        <p>Total data found - <b>{{ count(session()->get('array')['total']) }}</b></p>
                        <p>Total data imported - <b>{{ count(session()->get('array')['imported']) }}</b></p>
                        <p class="{{ count(session()->get('array')['duplicate']) > 0 ? 'text-red-500' : ''}}">Duplicate data found <i>(Not imported)</i> - <b>{{ count(session()->get('array')['duplicate']) }}</b></p>
                        <p class="{{ count(session()->get('array')['skipped']) > 0 ? 'text-red-500' : ''}}">Skipped data(s) for wrong format or error(s) - <b>{{ count(session()->get('array')['skipped']) }}</b></p>
                        <p class="{{ count(session()->get('array')['entryError']) > 0 ? 'text-red-500' : ''}}">Error in Entry - <b>{{ count(session()->get('array')['entryError']) }}</b></p>
                        @if (count(session()->get('array')['entryError']) > 0)
                            <p class="text-red-500 font-bold">Errors:</p>
                            <table class="min-w-full bg-white border border-red-200">
                                <thead>
                                    <tr class="bg-red-200 text-red-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left w-1/2">Data Row</th>
                                        <th class="py-3 px-6 text-left w-1/2">Error</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-light">
                                    @foreach (session()->get('array')['entryError'] as $error)
                                        <tr class="border-b border-red-200 hover:bg-red-50">
                                            <td class="text-gray-700 py-3 px-6 text-left">{{ implode('|', $error['data']) }}</td>
                                            <td class="text-red-600 py-3 px-6 text-left">{{ $error['message'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <p class="font-bold text-blue-500">{{ session()->get('array')['message'] }}</p>
                        <a class="text-indigo-600 underline hover:text-indigo-900 block mt-6" href="{{ route('itee.admit-card.import') }}">Import another file</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
