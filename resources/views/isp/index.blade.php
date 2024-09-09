<x-app-layout>
    @section('title', 'ISPs')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ISPs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-5 mb-6">
                        <a href="?filter=approved" class="p-7 py-8 select-none {{ request('filter') == 'approved' ? 'bg-[#2B7381] text-white' : 'text-[#2B7381] bg-slate-200 hover:bg-slate-300' }} rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold">{{ $activeStaffCount }}</h1>
                            <h4 class="font-bold">Active ISP</h4>
                        </a>
                        <a href="?filter=pending" class="p-7 py-8 select-none {{ request('filter') == 'pending' ? 'bg-[#2A977A]  text-white' : 'text-[#2A977A] bg-slate-200 hover:bg-slate-300' }} rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold">{{ $pendingStaffCount }}</h1>
                            <h4 class="font-bold">Pending Request</h4>
                        </a>
                    </div>
                    @if (request()->has('filter'))
                        <div class="flex justify-between items-center mb-5 mx-6">
                            <p class="font-bold text-gray-600">Filter: <span class="text-gray-700 bg-gray-200 inline-block p-1 px-2 rounded-md hover:bg-gray-300 active:bg-gray-100 transition-colors cursor-default select-none">{{ request()->filter }}</span></p>
                            <a href="{{ route('isp.index') }}" class="text-blue-500 hover:underline">Show All</a>
                        </div>
                    @endif
                    {{--  --}}
                    {{--  --}}
                    <div class="overflow-x-auto">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($isp_staffs as $staff)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $staff->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $staff->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ ['Pending', 'Active'][$staff->active] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            <a href="{{ route('isp.view', $staff->id) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- $users->links() --}}
                    {{--  --}}
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
    @section('initDataTable', true)
    @section('scripts')
        <script>
            var dtable = $('#datatable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['copy', 'print']
                    }
                }
            });
            dtable.buttons().container().addClass('tableButtonsContainer');
        </script>
    @endsection
</x-app-layout>
