<x-app-layout>
    @section('title', 'Course PDF')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Course PDF') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of pdfs</h1>
                        <a href="{{ route('bkiict.course_pdf.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new pdf</a>
                    </div>
                    <div class="overflow-x-auto mt-5">
                        <table id="datatable" class="min-w-full divide-y divide-gray-200 mt-5">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[1%]">#</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[20%]">Course PDF Name</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[4%]">Latest to download</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[4%]">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 !text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider w-[5%]">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pdfs as $pdf)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 text-gray-900">{{ $pdf->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <form action="{{ url()->current() }}" method="post" class="closest_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $pdf->id }}">
                                                <input type="radio" class="form_radio cursor-pointer disabled:opacity-30" name="latest" @checked($pdf->front) @disabled(!$pdf->status)>
                                            </form>
                                            {{-- <div class="text-sm leading-5 text-gray-900">{{ $pdf->name }}</div> --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="!text-left text-sm leading-5 text-gray-900">{!! ['<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Inactive</span>', '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>'][$pdf->status] !!}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                                <a href="{{ route('bkiict.course_pdf.edit', $pdf->id) }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">Edit</a>
                                                <a href="{{ asset($pdf->file) }}" target="_blank" {{-- download="{{ $pdf->name }}.pdf" --}} class="text-green-600 hover:text-green-900 hover:underline">Download</a>
                                                <a href="{{ route('bkiict.course_pdf.delete', $pdf->id) }}" class="delete-data text-red-600 hover:text-red-900 hover:underline">Delete</a>
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
                title: "Delete Course PDF",
                content: "Do you really want to delete this Course PDF?",
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

            $('.form_radio').click((e) => {
                $(e.target).closest('.closest_form').submit();
            })
        </script>
    @endsection
</x-app-layout>
