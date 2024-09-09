@use('App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- <div class="grid grid-cols-3 gap-5 mb-6">
                        <a href="?filter=approved" class="p-7 py-12 select-none bg-[#2B7381] rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold text-white">0</h1>
                            <h4 class="text-white font-bold">Active ISP</h4>
                        </a>
                        <a href="?filter=pending" class="p-7 py-12 select-none bg-[#2A977A] rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold text-white">1</h1>
                            <h4 class="text-white font-bold">Pending Request</h4>
                        </a>
                        <a href="?filter=rejected" class="p-7 py-12 select-none bg-[#29B473] rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold text-white">0</h1>
                            <h4 class="text-white font-bold">Rejected</h4>
                        </a>
                    </div>
                    @if (request()->has('filter'))
                        <div class="flex justify-between items-center mb-5 mx-6">
                            <p class="font-bold text-gray-600">Filter: <span class="text-gray-700 bg-gray-200 inline-block p-1 px-2 rounded-md hover:bg-gray-300 active:bg-gray-100 transition-colors cursor-default select-none">{{ request()->filter }}</span></p>
                            <a href="{{ route('isp.index') }}" class="text-blue-500 hover:underline">Show All</a>
                        </div>
                    @endif --}}
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of User</h1>
                        <a href="{{ route('user.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new User</a>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($bcc_Staffs as $staff)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="flex items
                                            -center">
                                                <div>
                                                    <div class="text-sm leading-5 font-medium text-gray-900"> {{ $staff->name }} </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $staff->email }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $staff->active == 1 ? 'Active' : 'Inactive' }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ Helper::userRoleName($staff) }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                            <a href="{{ route('user.view', ['id' => $staff->id]) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
                                            <a href="{{ route('user.delete', ['id' => $staff->id]) }}" class="delete-bcc-staff text-red-600 hover:text-red-900 hover:underline">Delete</a>
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

            $('a.delete-bcc-staff').confirm({
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
