@use('\App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'NDC Appointment')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('NDC Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (request('filter') == 'accepted')
                        <h1 class="text-center text-2xl font-bold my-4 mb-8 text-green-700">Accepted Appointment</h1>
                    @elseif (request('filter') == 'pending')
                        <h1 class="text-center text-2xl font-bold my-4 mb-8 text-blue-700">Pending Appointment</h1>
                    @elseif (request('filter') == 'declined')
                        <h1 class="text-center text-2xl font-bold my-4 mb-8 text-red-700">Declined Appointment</h1>
                    @endif
                    <div class="grid sm:grid-cols-3 grid-cols-1 gap-3 mt-5 mb-7">
                        <a href="?filter=accepted" class="flex justify-center items-center group transition-all active:shadow-sm text-green-500 hover:text-green-700 border-green-500 hover:border-green-700 hover:shadow-lg rounded gap-3 p-2 border-t-4 shadow-md text-uppercase font-bold">Accepted <span class="flex justify-center items-center text-white text-xs w-5 aspect-square rounded-full bg-green-500 group-hover:bg-green-700 transition-colors">{{ $acceptedCount }}</span></a>
                        <a href="?filter=pending" class="flex justify-center items-center text-blue-500 group transition-all active:shadow-sm hover:text-blue-700 hover:border-blue-700 hover:shadow-lg rounded gap-3 p-2 border-t-4 border-blue-500 shadow-md text-uppercase font-bold">Pending <span class="flex justify-center items-center text-white text-xs w-5 aspect-square rounded-full bg-blue-500 transition-colors group-hover:bg-blue-700">{{ $pendingCount }}</span></a>
                        <a href="?filter=declined" class="flex justify-center items-center text-red-500 group transition-all active:shadow-sm hover:text-red-700 hover:border-red-700 hover:shadow-lg rounded gap-3 p-2 border-t-4 border-red-500 shadow-md text-uppercase font-bold">Declined <span class="flex justify-center items-center text-white text-xs w-5 aspect-square rounded-full bg-red-500 transition-colors group-hover:bg-red-700">{{ $rejectedCount }}</span></a>
                    </div>

                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Purpose</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Appointment Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Appointment Time</th>
                                    @if (request('filter') == 'accepted' && Helper::canView('Update Time NDC Appointment', 'Super Admin'))
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Update Entry time</th>
                                    @endif
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($bcc_Staffs as $staff)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900"> {{ $staff->purpose }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $staff->date }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $staff->time }} </div>
                                        </td>
                                        @if (request('filter') == 'accepted' && Helper::canView('Update Time NDC Appointment', 'Super Admin'))
                                            <td class="px-6 py-4 whitespace-no-wrap">
                                                <input type="time" name="update_time" id="entry_time_{{ $staff->id }}" value="{{ $staff->entry_time }}" step="1" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <button id="update-entry-{{ $staff->id }}" data-id="{{ $staff->id }}" class="update_entry_time p-2 px-3 ml-1 text-white bg-indigo-500 hover:bg-indigo-600 border-gray-300 rounded-md shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">Update</button>
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $staff->status }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium {{-- flex justify-end items-center --}} gap-2">
                                            <a href="{{ route('ndc.appointment.view', ['id' => $staff->id, 'back_filter' => request('filter')]) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
                                            @if (Helper::canView('Approve NDC Appointment', 'Super Admin') && request('filter') == 'pending')
                                                <a href="{{ route('ndc.appointment.approve', ['id' => $staff->id]) }}" class="delete-bcc-staff text-green-600 hover:text-green-900 hover:underline">Approve</a>
                                            @endif
                                            @if (Helper::canView('Print NDC Appointment', 'Super Admin') && request('filter') != 'pending')
                                                <a target="_blank" href="{{ route('ndc.appointment.print', ['id' => $staff->id]) }}" class="text-red-600 hover:text-red-900 hover:underline">Print</a>
                                            @endif
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
                }
            });
            dtable.buttons().container().addClass('tableButtonsContainer');
            $('a.delete-bcc-staff').confirm({
                title: "Accept Appointmnet",
                content: "Do you really want to accept this appointment?",
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
            $('.update_entry_time').click((e) => {
                const id = $(e.currentTarget).data('id');
                const entry_time = $('#entry_time_' + id).val();
                const url = '{{ route('ndc.appointment.update_entry_time') }}';
                const data = {
                    id: id,
                    time: entry_time
                };
                $.ajax({
                    type: "post",
                    url: url,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                    }
                });
            })
        </script>
    @endsection
</x-app-layout>
