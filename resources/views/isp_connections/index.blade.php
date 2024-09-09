<x-app-layout>
    @section('title', 'ISP Connections')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ISP Connections') }}
        </h2>
    </x-slot>

    @php
        $filters = ['accepted', 'pending', 'rejected'];
        $colors = ['bg-green-', 'bg-blue-', 'bg-red-'];
    @endphp
    {{-- @dd(auth()->user()->id) --}}
    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-center items-center my-5 mt-9">
                    {{-- all button --}}
                    <a href="{{ route('isp_connection.index') }}" class="block text-green-600 border-green-600 {{ request()->has('nttn') ? 'text-green-600 bg-white hover:text-white hover:bg-green-500' : 'text-white bg-green-600' }} border-2 px-5 py-2 mr-2 rounded-lg">All</a>
                    <a href="?nttn=sbl" class="block text-green-600 border-green-600 {{ request('nttn') == 'sbl' ? 'text-white bg-green-600' : 'text-green-600 bg-white hover:text-white hover:bg-green-500' }} border-2 border-r-[1px] px-5 py-2 rounded-l-lg">SecureNet Bangladesh Limited ({{ $sbl_count }})</a>
                    <a href="?nttn=adsl" class="block text-green-600 border-green-600 {{ request('nttn') == 'adsl' ? 'text-white bg-green-600' : 'text-green-600 bg-white hover:text-white hover:bg-green-500' }} border-2 border-l-[1px] px-5 py-2 rounded-r-lg">Advanced Digital Solution Limited ({{ $adsl_count }})</a>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="grid grid-rows-3 grid-cols-1 sm:grid-rows-1 sm:grid-cols-3 gap-5 mb-6 text-center">
                        <a href="?filter={{ $filters[0] }}{{ request()->has('nttn') ? '&nttn=' . request('nttn') : '' }}" class="p-7 py-9 select-none {{ request()->filter == $filters[0] ? 'bg-green-800' : 'bg-gray-100' }} {{-- bg-[#2B7381] --}} rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold {{ request()->filter == $filters[0] ? 'text-white' : 'text-green-800' }}">{{ $accepted_count }}</h1>
                            <h4 class="{{ request()->filter == $filters[0] ? 'text-white' : 'text-green-800' }} font-bold">Active {{ $accepted_count == 1 ? 'Connection' : 'Connections' }}</h4>
                        </a>
                        <a href="?filter={{ $filters[1] }}{{ request()->has('nttn') ? '&nttn=' . request('nttn') : '' }}" class="p-7 py-9 select-none {{ request()->filter == $filters[1] ? 'bg-blue-800' : 'bg-gray-100' }} {{-- bg-[#2A977A] --}} rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold {{ request()->filter == $filters[1] ? 'text-white' : 'text-blue-800' }}">{{ $pending_count }}</h1>
                            <h4 class="{{ request()->filter == $filters[1] ? 'text-white' : 'text-blue-800' }} font-bold">Pending {{ $pending_count == 1 ? 'Request' : 'Requests' }}</h4>
                        </a>
                        <a href="?filter={{ $filters[2] }}{{ request()->has('nttn') ? '&nttn=' . request('nttn') : '' }}" class="p-7 py-9 select-none {{ request()->filter == $filters[2] ? 'bg-red-800' : 'bg-gray-100' }} {{-- bg-[#29B473] --}} rounded-2xl shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg">
                            <h1 class="text-5xl font-bold {{ request()->filter == $filters[2] ? 'text-white' : 'text-red-800' }}">{{ $rejected_count }}</h1>
                            <h4 class="{{ request()->filter == $filters[2] ? 'text-white' : 'text-red-800' }} font-bold">Declined</h4>
                        </a>
                    </div>
                    @if (request()->has('filter') || request()->has('nttn'))
                        <div class="flex justify-between items-center mb-5 mx-6">
                            <p class="font-bold text-gray-600">Filter:
                                @if (request()->has('filter'))
                                    <span class="text-gray-700 bg-gray-200 inline-block p-1 px-2 rounded-md hover:bg-gray-300 active:bg-gray-100 transition-colors cursor-default select-none">{{ request()->filter }}</span>
                                @endif
                                @if (request()->has('nttn'))
                                    <span class="text-gray-700 bg-gray-200 inline-block p-1 px-2 rounded-md hover:bg-gray-300 active:bg-gray-100 transition-colors cursor-default select-none">{{ ['sbl' => 'SecureNet Bangladesh Limited', 'adsl' => 'Advanced Digital Solution Limited'][request()->nttn] }}</span>
                                @endif
                            </p>
                            <a href="{{ route('isp_connection.index') }}" class="text-blue-500 hover:underline">Clear filter</a>
                        </div>
                    @endif
                    {{-- @if (request()->has('nttn'))
                        <div class="flex justify-between items-center mb-5 mx-6">
                            <p class="font-bold text-gray-600">Filter: <span class="text-gray-700 bg-gray-200 inline-block p-1 px-2 rounded-md hover:bg-gray-300 active:bg-gray-100 transition-colors cursor-default select-none">{{ ['sbl' => 'SecureNet Bangladesh Limited', 'adsl' => 'Advanced Digital Solution Limited'][request()->nttn] }}</span></p>
                            <a href="{{ route('isp_connection.index') }}" class="text-blue-500 hover:underline">Show All</a>
                        </div>
                    @endif --}}
                    {{--  --}}
                    {{--  --}}
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Request Type</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">NTTN</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link Capacity</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Request time</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- @if ($connections->isEmpty())
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 text-center">No Connection Found!</td>
                                    </tr>
                                @endif --}}
                                @foreach ($connections as $connection)
                                    <tr class="{{ $colors[array_search(lcfirst($connection->status), $filters)] . '50' }}">
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $connection->request_type }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $connection->nttnProvider?->provider?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $connection->link_capacity }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">
                                                {!! ['<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Pending</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Declined</span> '][array_search(lcfirst($connection->status), $filters)] !!}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $connection->created_at }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                            <a href="{{ route('isp_connection.view', $connection->id) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
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
            var dtable = $('#datatable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['copy', 'print']
                        // 'copy', 'csv', 'excel', 'pdf', 'print'

                        // buttons: [{
                        //         extend: 'copyHtml5',
                        //         exportOptions: {
                        //             columns: [0, ':visible']
                        //         }
                        //     },
                        //     {
                        //         extend: 'csvHtml5',
                        //         exportOptions: {
                        //             columns: ':visible'
                        //         }
                        //     },
                        //     {
                        //         extend: 'excelHtml5',
                        //         exportOptions: {
                        //             columns: ':visible'
                        //         }
                        //     },
                        //     {
                        //         extend: 'pdfHtml5',
                        //         exportOptions: {
                        //             columns: [0, 1, 2, 5]
                        //         }
                        //     },
                        //     'colvis'
                        // ]
                    }
                }
            });
            dtable.buttons().container().addClass('tableButtonsContainer');
        </script>
    @endsection

</x-app-layout>
