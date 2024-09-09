<x-app-layout>
    @section('title', 'ITEE Notice')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ITEE Notice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of Notice</h1>
                        <a href="{{ route('itee.notice.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new noitce</a>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Notice</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="flex items
                                            -center">
                                                <div>
                                                    <div class="text-sm leading-5 font-medium text-gray-900"> {{ $item->notice }} </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900"> {{ $item->status == 1 ? 'Active' : 'Inactive' }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                            <a href="{{ route('itee.notice.edit', ['id' => $item->id]) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">Edit</a>
                                            <a href="{{ route('itee.notice.delete', ['id' => $item->id]) }}" class="delete-bcc-staff text-red-600 hover:text-red-900 hover:underline">Delete</a>
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
                title: "Delete Notice",
                content: "Do you really want to delete this Notice?",
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
