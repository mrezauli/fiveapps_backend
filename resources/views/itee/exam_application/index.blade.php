<x-app-layout>
    @section('title', 'ITEE Exam Applicaton')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ITEE Exam Applicaton') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of Exam Application</h1>

                        <div>
                            {{-- <a href="{{ route('itee.exam.application.import') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Import</a> --}}
                            <a href="{{ route('itee.exam.application.choose-export') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Export</a>
                        </div>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Examine ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Fee</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $item->examine_id }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900"> {{ $item->full_name }} </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">
                                                {{ $item->exam_fees }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $item->payment }} </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $item->transaction_id ?? 'None' }} </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ ['Pending', 'Accepted'][$item->status] }} </div>
                                        </td>


                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                            @if ($item->payment == 'Paid')
                                                @if ($item->status == 0)
                                                    <a href="{{ route('itee.exam.application.approve', ['id' => $item->id]) }}" class="approve-application text-green-600 hover:text-green-900 hover:underline">Approve</a>
                                                @else
                                                    <a href="{{ route('itee.exam.application.delete', ['id' => $item->id]) }}" class="delete-itee-application text-red-600 hover:text-red-900 hover:underline">Delete</a>
                                                @endif
                                            @else
                                                <a href="{{ route('itee.exam.application.delete', ['id' => $item->id]) }}" class="delete-itee-application text-red-600 hover:text-red-900 hover:underline">[Remove]</a>
                                            @endif
                                            <a href="{{ route('itee.exam.application.view', ['id' => $item->id]) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">View</a>
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

            $('a.approve-application').confirm({
                title: "Approve Application",
                content: "Do you really want to approve this application?",
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

            $('a.delete-itee-application').confirm({
                title: "Delete Application",
                content: "Do you really want to delete this application?",
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
