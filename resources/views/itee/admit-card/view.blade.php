<x-app-layout>
    @section('title', 'Admit Card Details')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admit Card Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">Admit Card Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <a target="_blank" href="{{ route('itee.download.admit', base64_encode($ac_data->id)) }}" class="select-none bg-blue-500 hover:bg-blue-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Download Admit Card</span>
                            </a>
                            <a href="{{ route('itee.admit-card.edit', $ac_data->id) }}" class="select-none bg-red-500 hover:bg-red-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Edit</span>
                            </a>
                            <a href="{{ route('itee.admit-card.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Examine name: <span class="font-normal">{{ $ac_data->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Examine Id: <span class="font-normal">{{ $ac_data->examine_id }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">PIN: <span class="font-normal">{{ $ac_data->pin }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">SEX: <span class="font-normal">{{ $ac_data->sex }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Date of Birth: <span class="font-normal">{{ $ac_data->dob }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Area: <span class="font-normal">{{ $ac_data->area }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Site: <span class="font-normal">{{ $ac_data->site }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Room No: <span class="font-normal">{{ $ac_data->room_no }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Post Code: <span class="font-normal">{{ $ac_data->post_code }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Address: <span class="font-normal">{{ $ac_data->address }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Phone: <span class="font-normal">{{ $ac_data->phone }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Email: <span class="font-normal">{{ $ac_data->email }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exempt: <span class="font-normal">{{ $ac_data->exempt }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        {{-- <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: {!! ['<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Inactive</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>'][$book->status] !!}</p>
                        </div> --}}
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Added around: <span class="font-normal">{{ $ac_data->created_at->diffForHumans() }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Updated around: <span class="font-normal">{{ $ac_data->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
