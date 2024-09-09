<x-app-layout>
    @section('title', 'Connection View')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Connection') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">Connection Details</p>
                        </div>
                        <a href="{{ route('isp_connection.index') }}" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                            <span class="font-bold text-white">Back</span>
                        </a>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Request type: <span class="font-normal">{{ $connection->request_type }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Division: <span class="font-normal">{{ $connection->division->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">District: <span class="font-normal">{{ $connection->district->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Upazila: <span class="font-normal">{{ $connection->upazila->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Union: <span class="font-normal">{{ $connection->union->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">NTTN Provider: <span class="font-normal">{{ $connection->nttnProvider?->provider?->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Link Capacity: <span class="font-normal">{{ $connection->link_capacity }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Remark: <span class="font-normal">{{ $connection->remark }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: {!! ['Accepted' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>', 'Pending' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Pending</span>', 'Rejected' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Declined</span> '][$connection->status] !!} {{-- <span class="font-normal">{{ $connection->status }}</span> --}}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Registered around: <span class="font-normal">{{ $connection->created_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    @if ($connection->status == 'Pending')
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-2">
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Actions:</p>
                            </div>
                            <div class="flex justify-between items-center gap-2">
                                <form method="POST" action="{{ route('isp_connection.approve', $connection->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Approve</span>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('isp_connection.reject', $connection->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#FF4D4D] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Decline</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
