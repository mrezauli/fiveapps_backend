<x-app-layout>
    @section('title', 'B-JET Event View')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('B-JET Event View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">B-JET Event Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('itee.bjet.edit', $event->id) }}" class="select-none bg-red-500 hover:bg-red-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Edit</span>
                            </a>
                            <a href="{{ route('itee.bjet.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Label: <span class="font-normal">{{ $event->label }}</span></p>
                        </div>
                        <div class="flex flex-col justify-between items-start my-2">
                            <p class="font-bold text-gray-600">Image:</p>
                            <div class="flex justify-center items-center">
                                <img src="{{ asset($event->image) }}" alt="{{ $event->label }}" class="w-56 h-56 object-cover rounded-lg outline-slate-600">
                            </div>
                        </div>
                        @if ($event->description)
                            <div class="flex flex-col justify-between items-start">
                                <p class="font-bold text-gray-600">Description:</p>
                                <div class="font-normal bg-gray-200 p-1 px-2 whitespace-pre-wrap">{!! $event->description ?? '<i style="color: #a0a0a0">N/A</i>' !!}</div>
                            </div>
                        @else
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Description: <span class="inline-block font-normal italic text-gray-400 text-sm bg-gray-200 p-1 px-2">N/A</span></p>
                                {{-- <p class="font-bold text-gray-600">Description:</p>
                            <div class="font-normal bg-gray-200 p-1 px-2 whitespace-pre-wrap">{!! $event->description ?? '<i style="color: #a0a0a0">N/A</i>' !!}</div> --}}
                            </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: <span class="font-normal">{{ ['Inactive', 'Active'][$event->status] }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">

                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Added around: <span class="font-normal">{{ $event->created_at->diffForHumans() }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Updated around: <span class="font-normal">{{ $event->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
