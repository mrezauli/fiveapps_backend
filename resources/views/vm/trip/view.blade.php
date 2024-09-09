@use('\App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'Trip Details')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trip Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">Trip Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('vm.cars.trip.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Name: <span class="font-normal">{{ $trip?->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Designation: <span class="font-normal">{{ $trip?->designation }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Department: <span class="font-normal">{{ $trip?->department }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Purpose: <span class="font-normal">{{ $trip?->purpose }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Phone: <span class="font-normal">{{ $trip?->phone }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Trip: <span class="font-normal">{{ $trip?->destination_from .' - '. $trip?->destination_to }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Trip Category: <span class="font-normal">{{ $trip?->trip_category}}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Date: <span class="font-normal">{{ Carbon\Carbon::parse($trip?->date)->format('d-m-Y' )}}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Start Time: <span class="font-normal">{{ Carbon\Carbon::parse($trip?->start_time)->format('g:i: A' )}}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">End Time: <span class="font-normal">{{ Carbon\Carbon::parse($trip?->end_time)->format('g:i: A' )}}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Approx Distance: <span class="font-normal">{{ $trip?->approx_distance}}</span></p>
                        </div>
                        @if (!is_null($trip->attachment_file) && file_exists(public_path($trip->attachment_file)))
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Attachment File: <span class="font-normal"> <a href="{{ asset($trip->attachment_file) }}" download="download">Download</a> </span></p>
                            </div>
                        @endif
                        
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            {{-- <p class="font-bold text-gray-600">Status: {!! ['<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Inactive</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>'][$trip?->status] !!}</p> --}}
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Added around: <span class="font-normal">{{ $trip?->created_at->diffForHumans() }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Updated around: <span class="font-normal">{{ $trip?->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                     @if (Helper::canView('VM Car Assign Trip', 'Super Admin') && ($trip->status == 'Accepted' && is_null($trip->driver_with_car_id))) 
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex justify-start items-center gap-2">
                            <div class="flex justify-between items-center gap-2">
                                <form method="POST" action="{{ route('vm.cars.trip.driver.assign') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $trip->id }}" name="trip_id">
                                    <div>
                                        <x-input-label for="driver" :value="__('Driver')" />
                                        <x-select id="driver" name="car_id" class="mt-1 block w-full" required>
                                            <option selected value="">Select Driver</option>
                                            @foreach ($driver as $item)
                                                <option value="{{ $item->id }}"> {{ $item->user?->name }} </option>
                                            @endforeach
                                        </x-select>
                                        <x-input-error class="mt-2" :messages="$errors->get('driver')" />
                                    </div>
                                    <x-primary-button>{{ __('Assign Driver') }}</x-primary-button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
