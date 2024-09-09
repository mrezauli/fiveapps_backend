<x-app-layout>
    @section('title', 'Courses')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Courses') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of courses</h1>
                        <a href="{{ route('bkiict.course.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new course</a>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[1%]">#</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[20%]">Course Name</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Course type</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Shift</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Fee</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[4%]">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[5%]">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $course->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ ['short' => 'Short Course', 'long' => 'Long Course', 'customized' => 'Customized Course'][$course->type] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $course->shift }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $course->fee }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            {{-- <div class="!text-left text-sm leading-5 text-gray-900">{!! [
                                                'ongoing' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ongoing</span>',
                                                'upcoming' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Upcoming</span>',
                                                'deactive' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Deactive</span>',
                                            ][$course->status] !!}</div> --}}
                                            <div class="text-sm leading-5 text-gray-900">{!! $course->status ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Active</span>' : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>' !!}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                                <a href="{{ route('bkiict.course.edit', $course->id) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">Edit</a>
                                                <a href="{{ route('bkiict.course.delete', $course->id) }}" class="delete-data text-red-600 hover:text-red-900 hover:underline">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('initDataTable', true)
    @section('scripts')
        <script>
            $('#datatable').DataTable({
                "order": []
            });

            $('.delete-data').confirm({
                title: "Delete Course",
                content: "Do you really want to delete this Course?",
                buttons: {
                    no: {
                        text: 'No',
                        btnClass: 'btn-default',
                        action: function() {}
                    },
                    yes: {
                        text: 'Yes',
                        btnClass: 'btn-danger',
                        action: function() {
                            location.href = this.$target.attr('href');
                        }
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>
