@use('\App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'Trip Information')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Trip Information') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of cars</h1>
                        {{-- <a href="{{ route('vm.cars.assign.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new Trip information</a> --}}
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[1%]">#</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[20%]">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Vehicle Name</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Vehicle Number</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Form</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">To</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Date</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Start Time</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">End Time</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Approx Distance</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[7%]">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[5%]">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($trips as $trip)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $trip->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->driverWithCar?->car?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->driverWithCar?->car?->vehicle_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->destination_from }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->destination_to }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ \Carbon\Carbon::parse($trip->date)->format('d-m-Y') ?? 'No Date' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->start_time }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->end_time }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->approx_distance }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{{ $trip->status }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                                @if (Helper::canView('Approve VM Trip', 'Super Admin'))
                                                    <a href="{{ route('vm.cars.trip.approve', $trip->id) }}" class="delete-data text-blue-300-600 hover:text-red-900 hover:underline">Approve</a>
                                                @endif
                                                <a href="{{ route('vm.cars.trip.view', $trip->id) }}" class="text-yellow-600 hover:text-indigo-900 hover:underline">View</a>
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
                title: "Delete Car Information",
                content: "Do you really want to approve this Trip?",
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
