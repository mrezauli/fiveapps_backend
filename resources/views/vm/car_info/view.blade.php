<x-app-layout>
    @section('title', 'Car Details')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">Car Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('vm.cars.edit', $car->id) }}" class="select-none bg-red-500 hover:bg-red-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Edit</span>
                            </a>
                            <a href="{{ route('vm.cars.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Car name: <span class="font-normal">{{ $car->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Model number: <span class="font-normal">{{ $car->model_number }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Vehicle number: <span class="font-normal">{{ $car->vehicle_number }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: {!! ['<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Inactive</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>'][$car->status] !!}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Added around: <span class="font-normal">{{ $car->created_at->diffForHumans() }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Updated around: <span class="font-normal">{{ $car->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    {{-- <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex justify-start items-center gap-2">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status:</p>
                        </div>
                        <div class="flex justify-between items-center gap-2">
                            <form method="POST" action="{{ route('isp_connection.approve', $car->id) }}">
                                @csrf
                                <button type="submit" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                    <span class="font-bold text-white">Set Inactive</span>
                                </button>
                            </form>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
