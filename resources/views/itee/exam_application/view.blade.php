<x-app-layout>
    @section('title', 'ITEE Exam Applicaton Details')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('ITEE Exam Applicaton Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mx-5 mb-4">
                        <div class="flex items-center justify-center">
                            <p class="text-lg font-bold text-gray-600">ITEE Exam Applicaton Details Details</p>
                        </div>
                        <div class="flex items-center justify-center gap-3">

                            <a href="{{ route('itee.exam.application.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col items-start justify-center gap-1 px-6 py-5 mx-5 mt-6 bg-gray-100 rounded">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Examine ID: <span class="font-normal">{{ $application->examine_id ?? 'None' }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Name: <span class="font-normal">{{ $application->full_name }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Email: <span class="font-normal">{{ $application->email }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Phone: <span class="font-normal">{{ $application->phone }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Date of birth: <span class="font-normal">{{ $application->dob }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Gender: <span class="font-normal">{{ ucfirst($application->gender) }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Address: <span class="font-normal">{{ $application->address }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Post code: <span class="font-normal">{{ $application->post_code }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Occupation: <span class="font-normal">{{ $application->occupation }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Education qualification: <span class="font-normal">{{ $application->education_qualification }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Subject name: <span class="font-normal">{{ $application->subject_name }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Passing year: <span class="font-normal">{{ $application->passing_year }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Institute name: <span class="font-normal">{{ $application->institute_name }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Result: <span class="font-normal">{{ $application->result }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Category: <span class="font-normal">{{ $application->category?->name }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            {{-- <p class="font-bold text-gray-600">Venue: <span class="font-normal">{{ $application->venue?->name }}</span></p> --}}
                            <p class="font-bold text-gray-600">Exam Center: <span class="font-normal">{{ $application->exam_center }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Exam type: <span class="font-normal">{{ $application->examType?->name }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Exam fee: <span class="font-normal">{{ $application->exam_fees }}</span></p>
                        </div>
                        <fieldset class="w-full p-2 pt-0 border border-gray-400">
                            <legend class="font-bold text-gray-600">Books</legend>
                            <p class="font-bold text-gray-600">Total Fee: <span class="font-normal">{{ $application->itee_book_fees ?? 'None' }}</span> | Total Books: <span class="font-normal">{{ $application->getBooks()->count() }}</span></p>
                            <hr>
                            @foreach ($application->getBooks() as $books)
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-600">Title: <span class="font-normal">{{ $books->book_name }}</span></p>
                            </div>
                            @endforeach
                        </fieldset>
                        <div class="flex items-center justify-between">
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Previous passing id: <span class="font-normal">{{ $application->previous_passing_id ?? 'None' }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Transaction id: <span class="font-normal">{{ $application->transaction_id ?? 'None' }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Payment: <span class="font-normal">{{ $application->payment }}</span></p>
                        </div>
                    </div>
                    <div class="flex flex-col items-start justify-center gap-1 px-6 py-5 mx-5 mt-6 bg-gray-100 rounded">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Status: <span class="font-normal">{{ ['Pending', 'Accepted', 'Rejected'][$application->status] }}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-gray-600">Registered around: <span class="font-normal">{{ $application->created_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
