<x-app-layout>
    @section('title', 'BKIICT User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('BKIICT User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of User</h1>
                        <a href="{{ route('bkiict.user.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new user</a>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User Type</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="flex items
                                            -center">
                                                <div>
                                                    <div class="text-sm leading-5 font-medium text-gray-900"> {{ $student->name }} </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $student->email }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $student->user_type == 'bkiict_admin' ? 'Admin' : 'Student' }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $student->active == 1 ? 'Active' : 'Inactive' }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                            <a href="{{ route('bkiict.user.view', $student->id) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
                                            <a href="{{ route('bkiict.user.delete', $student->id) }}" class="delete-student text-red-600 hover:text-red-900 hover:underline">Delete</a>
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

            $('a.delete-student').confirm({
                title: "Delete User",
                content: "Do you really want to delete this User?",
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
