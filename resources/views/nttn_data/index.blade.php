@use('\App\Helper\CustomHelper', 'Helper')

<x-app-layout>
    @section('title', 'NTTN Data')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('NTTN Data') }}
            </h2>
            <form action="{{ url()->current() }}" method="get" class="flex items-center gap-2">
                <input type="text" name="search" id="search" class="border border-gray-300 rounded px-2 py-1" value="{{ request()->search }}" placeholder="Search...">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Search</button>
            </form>
        </div>
    </x-slot>

    @if (request()->has('search'))
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8 mt-8 -mb-4">
            <div class="flex justify-between items-center mx-6">
                <p class="font-bold text-gray-600">Search results for '{{ request()->search }}'</p>
                <a href="{{ route('nttn.index') }}" class="text-red-500 hover:underline">
                    <small>Clear search</small>
                </a>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (Helper::userRoleName(auth()->user()) == 'Super Admin' || auth()->user()->user_type == 'bcc_staff')
                    <div class="flex justify-center items-center my-5 mt-9">
                        <a href="{{ route('nttn.index') }}" class="block text-green-600 border-green-600 {{ request()->has('nttn') ? 'text-green-600 bg-white hover:text-white hover:bg-green-500' : 'text-white bg-green-600' }} border-2 px-5 py-2 mr-2 rounded-lg">All</a>
                        <a href="?nttn=sbl" class="block text-green-600 border-green-600 {{ request('nttn') == 'sbl' ? 'text-white bg-green-600' : 'text-green-600 bg-white hover:text-white hover:bg-green-500' }} border-2 border-r-[1px] px-5 py-2 rounded-l-lg">SecureNet Bangladesh Limited ({{ $sbl_count }})</a>
                        <a href="?nttn=adsl" class="block text-green-600 border-green-600 {{ request('nttn') == 'adsl' ? 'text-white bg-green-600' : 'text-green-600 bg-white hover:text-white hover:bg-green-500' }} border-2 border-l-[1px] px-5 py-2 rounded-r-lg">Advanced Digital Solution Limited ({{ $adsl_count }})</a>
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of data</h1>
                        <a href="{{ route('nttn.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new data</a>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[1%]">#</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Division</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">District</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Upazila</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Union</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">NTTN</th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[1%]">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($nttns as $nttn)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $nttn->union?->upazila?->district?->division?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $nttn->union?->upazila?->district?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $nttn->union?->upazila?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $nttn->union?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $nttn->phone }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $nttn->provider?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                                <a href="{{ route('nttn.view', $nttn->id) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
                                                <a href="{{ route('nttn.delete', $nttn->id) }}" class="delete-nttn-staff text-red-600 hover:text-red-900 hover:underline">Delete</a>
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
            var dtable = $('#datatable').DataTable({
                layout: {
                    topStart: {
                        buttons: ['copy', 'print']
                    }
                },
                // ajax: {
                //     url: "{{-- route('nttn.records', ['type' => request('nttn')]) --}}",
                //     type: "GET",
                //     // data: function(data) {
                //     //     data.nttn = '{{-- request('nttn') --}}';
                //     // }
                // },
                // columns: [{
                //         data: 'id'
                //     },
                //     {
                //         data: 'union.district.division.name'
                //     },
                //     {
                //         data: 'union.district.name'
                //     },
                //     {
                //         data: 'union.upazila.district.name'
                //     },
                //     {
                //         data: 'union.upazila.name'
                //     },
                //     {
                //         data: 'union.name'
                //     },
                //     {
                //         data: 'phone'
                //     },
                //     {
                //         data: 'provider.name'
                //     },
                //     {
                //         data: 'action',
                //         orderable: false,
                //         searchable: false
                //     }
                // ],
            });
            dtable.buttons().container().addClass('tableButtonsContainer');

            $('a.delete-nttn-staff').confirm({
                title: "Delete NTTN Data",
                content: "Do you really want to delete this NTTN data?",
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
