<x-app-layout>
    @section('title', 'Result View')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Result View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">Result Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('itee.exam-fee.edit', $exam_fee->id) }}" class="select-none bg-red-500 hover:bg-red-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Edit</span>
                            </a>
                            <a href="{{ route('itee.exam-fee.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exam name: <span class="font-normal">{{ $exam_fee->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exam Category: <span class="font-normal">{{ $exam_fee->exam_category->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exam Type: <span class="font-normal">{{ $exam_fee->exam_type->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Fee: <span class="font-normal">{{ $exam_fee->fee }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exam Start Date: <span class="font-normal">{{ $exam_fee->exam_start }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exam End Date: <span class="font-normal">{{ $exam_fee->exam_end }}</span></p>
                        </div>
                        @if ($exam_fee->details)
                            <div class="flex flex-col justify-between items-start">
                                <p class="font-bold text-gray-600">Exam Details:</p>
                                <div class="font-normal bg-gray-200 p-1 px-2 whitespace-pre-wrap">{!! $exam_fee->details ?? '<i style="color: #a0a0a0">N/A</i>' !!}</div>
                            </div>
                        @else
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Exam Details: <span class="inline-block font-normal italic text-gray-400 text-sm bg-gray-200 p-1 px-2">N/A</span></p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        {{-- <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: {!! ['<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Inactive</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>'][$book->status] !!}</p>
                        </div> --}}
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Added around: <span class="font-normal">{{ $exam_fee->created_at->diffForHumans() }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Updated around: <span class="font-normal">{{ $exam_fee->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
