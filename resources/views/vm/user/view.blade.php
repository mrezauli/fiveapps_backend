<x-app-layout>
    @section('title', 'Vehicle Management User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Management User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">Vehicle Management User Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-3">
                            <a href="{{ route('vm.user.edit', $item->id) }}" class="select-none bg-red-500 hover:bg-red-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Edit</span>
                            </a>
                            <a href="{{ route('vm.user.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Name: <span class="font-normal">{{ $item->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Email: <span class="font-normal">{{ $item->email }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Designation: <span class="font-normal">{{ $item->designation }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: <span class="font-normal">{{ ucfirst($item->status) }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Registered around: <span class="font-normal">{{ $item->created_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Change password:</p>
                        </div>
                        <div class="flex justify-between items-center gap-2 mt-2">
                            <form method="POST" action="{{ route('change.password', $item->id) }}" class="space-y-3">
                                @csrf
                                <div>
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full lg:w-96" :value="old('password')" required autocomplete="password" />
                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                </div>
                                <div>
                                    <x-input-label for="confirm_password" :value="__('Confirm Password')" />
                                    <x-text-input id="confirm_password" name="confirm_password" type="password" class="mt-1 block w-full lg:w-96" :value="old('confirm_password')" required autocomplete="confirm_password" />
                                    <x-input-error class="mt-2" :messages="$errors->get('confirm_password')" />
                                </div>
                                <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                    <span class="font-bold text-white">Submit</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
