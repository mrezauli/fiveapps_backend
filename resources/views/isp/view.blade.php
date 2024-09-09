<x-app-layout>
    @section('title', 'ISP View')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View ISP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">ISP Details</p>
                        </div>
                        <a href="{{ route('isp.index') }}" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                            <span class="font-bold text-white">Back</span>
                        </a>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Name: <span class="font-normal">{{ $staff->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Email: <span class="font-normal">{{ $staff->email }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Phone: <span class="font-normal">{{ $staff->phone }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Organization: <span class="font-normal">{{ $staff->organization }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Designation: <span class="font-normal">{{ $staff->designation }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">User type: <span class="font-normal">{{ $staff->isp_user_type }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">License: <span class="font-normal">{{ $staff->license_number }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: <span class="font-normal">{{ ['Pending', 'Active'][$staff->active] }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Registered around: <span class="font-normal">{{ $staff->created_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    @if ($staff->active == 0)
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Actions:</p>
                            </div>
                            <div class="flex justify-between items-center gap-2">
                                <form method="POST" action="{{ route('isp.approve', $staff->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Approve</span>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('isp.delete', $staff->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#FF4D4D] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Delete</span>
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
