<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">

            {{-- @if (!request()->has('app')) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 pb-10">
                <div class="text-2xl font-bold px-1 my-1 mb-4">Apps</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 select-none">
                    <a href="{{ route('isp_connection.index') }}" class="h-64 p-6 flex flex-col justify-center items-center transition-shadow duration-300 hover:shadow-xl bg-green-100 rounded-md gap-4">
                        <div class="w-20 h-20 bg-gradient-to-b rounded-full shadow-md from-green-50 to-green-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/bcc_logo.png') }}" alt="" class="w-12 h-12 drop-shadow-md">
                        </div>
                        <h2 class="text-2xl font-bold text-green-800 drop-shadow-md">BCC Connect</h2>
                    </a>

                    <a href="{{ route('ndc.appointment.index') }}" class="h-64 p-6 flex flex-col justify-center items-center transition-shadow duration-300 hover:shadow-xl bg-cyan-100 rounded-md gap-4">
                        <div class="w-20 h-20 bg-gradient-to-b rounded-full shadow-md from-cyan-50 to-cyan-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/ndc_logo.png') }}" alt="" class="w-12 drop-shadow-md">
                        </div>
                        <h2 class="text-2xl font-bold text-cyan-900 drop-shadow-md">NDC</h2>
                    </a>

                    <a href="{{ route('itee.exam.application.index') }}" class="h-64 p-6 flex flex-col justify-center items-center transition-shadow duration-300 hover:shadow-xl bg-sky-100 rounded-md gap-4">
                        <div class="w-20 h-20 bg-gradient-to-b rounded-full shadow-md from-sky-50 to-sky-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/itec_logo.png') }}" alt="" class="w-12 drop-shadow-md">
                        </div>
                        <h2 class="text-2xl font-bold text-sky-700 drop-shadow-md">ITEE</h2>
                    </a>

                    <a href="{{ route('bkiict.course.index') }}" class="h-64 p-6 flex flex-col justify-center items-center transition-shadow duration-300 hover:shadow-xl bg-lime-100 rounded-md gap-4">
                        <div class="w-20 h-20 bg-gradient-to-b rounded-full shadow-md from-lime-50 to-lime-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/bkiict-logo.svg') }}" alt="" class="w-14 drop-shadow-md">
                        </div>
                        <h2 class="text-2xl font-bold text-lime-700 drop-shadow-md">BKIICT</h2>
                    </a>

                    <a href="{{ route('vm.cars.index') }}" class="h-64 p-6 flex flex-col justify-center items-center transition-shadow duration-300 hover:shadow-xl bg-red-100 rounded-md gap-4">
                        <div class="w-20 h-20 bg-gradient-to-b rounded-full shadow-md from-red-50 to-red-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/vehicle.svg') }}" alt="" class="w-10 drop-shadow-md">
                        </div>
                        <h2 class="text-xl font-bold text-red-900 drop-shadow-md">Vehicle Management</h2>
                    </a>
                </div>
            </div>
            {{-- @else --}}
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 pb-10">
                    <div class="flex justify-start items-center">
                        <a href="{{ route('dashboard') }}" class="flex justify-center items-center gap-2 bg-slate-200 hover:bg-slate-400 active:bg-slate-300 rounded px-3 py-1 text-gray-600 hover:text-gray-800 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>Back</span>
                        </a>
                    </div>

                    <div class="py-2 mt-2 flex flex-col justify-center items-start gap-3">
                        <div class="text-xl font-bold px-1 my-1">{{ $titles[request('app')] ?? '404' }}</div>
                        <div class="pl-8">
                            <ol class="list-decimal text-sm">
                                @php
                                    $module = $modules[request('app')] ?? null;
                                @endphp
                                @if ($module)
                                    @foreach ($module as $key => $value)
                                        <li><a href="{{ route($key) }}" target="_blank" class="text-sky-600 hover:text-sky-700 hover:underline">{{ $value }}</a></li>
                                    @endforeach
                                @else
                                    <p class="text-red-600 text-center -ml-7">No module available</p>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div> --}}
            {{-- @endif --}}

        </div>
    </div>
</x-app-layout>
