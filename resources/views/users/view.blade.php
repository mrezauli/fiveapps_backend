<x-app-layout>
    @section('title', 'User View')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">User Details</p>
                        </div>
                        <a href="{{ route('dashboard.users') }}" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                            <span class="font-bold text-white">Back</span>
                        </a>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Name: <span class="font-normal">{{ $user->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Email: <span class="font-normal">{{ $user->email }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: <span class="font-normal">{{ ucfirst($user->status) }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Registered around: <span class="font-normal">{{ $user->created_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    @if ($user->status == 'pending')
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Actions:</p>
                            </div>
                            <div class="flex justify-between items-center gap-2">
                                <form method="POST" action="{{ route('dashboard.users.approve', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Approve</span>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('dashboard.users.reject', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#FF4D4D] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Reject</span>
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
