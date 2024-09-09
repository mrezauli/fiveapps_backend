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
                            <a href="{{ route('itee.results.edit', $result->id) }}" class="select-none bg-red-500 hover:bg-red-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Edit</span>
                            </a>
                            <a href="{{ route('itee.results.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">PasserID: <span class="font-normal">{{ $result->passer_id }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Examinee No.: <span class="font-normal">{{ $result->examine_id }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Student name: <span class="font-normal">{{ $result->name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Birth Date: <span class="font-normal">{{ $result->dob }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Exam Type: <span class="font-normal">{{ strtoupper($result->exam_type) }}</span></p>
                        </div>
                        @if ($result->exam_type === 'fe')
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Morning Passer: <span class="font-normal">{{ $result->morning_passer ? 'Morning Exam' : 'N/A' }}</span></p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Afternoon Passer: <span class="font-normal">{{ $result->afternoon_passer ? 'Afternoon Exam' : 'N/A' }}</span></p>
                            </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Passing Session: <span class="font-normal">{{ $result->passing_session }}</span></p>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Added around: <span class="font-normal">{{ $result->created_at->diffForHumans() }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Updated around: <span class="font-normal">{{ $result->updated_at->diffForHumans() }}</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
