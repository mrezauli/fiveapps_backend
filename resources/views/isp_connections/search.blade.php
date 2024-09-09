<x-app-layout>
    @section('title', 'ISP Connections Search')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ISP Connections Search') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-3">
                <div class="p-6 text-gray-900">
                    <form action="{{ url()->current() }}" method="get" class="flex justify-center items-center gap-2">
                        <div>
                            <x-select id="division" name="division_id" class="block w-full">
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('division_id')" />
                        </div>
                        <div>
                            <x-select id="district" name="district_id" :disabled="true" class="block w-full">
                                <option value="">Select District</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('district_id')" />
                        </div>
                        <div>
                            <x-select id="upazila" name="upazila_id" :disabled="true" class="block w-full">
                                <option value="">Select Upazila</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('upazila_id')" />
                        </div>
                        <div>
                            <x-select id="union" name="union_id" :disabled="true" class="block w-full">
                                <option value="">Select Union</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('union_id')" />
                        </div>
                        {{-- <div>
                            <x-select id="nttn" name="nttn_provider" :disabled="true" class="block w-full">
                                <option value="">Select NTTN Provider</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('nttn_provider')" />
                        </div> --}}
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">Search</button>
                    </form>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of datas</h1>
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
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">NTTN</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($connections as $connection)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900"> {{ $loop->iteration }} </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $connection->division?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $connection->district?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $connection->upazila?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $connection->union?->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap">
                                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $connection->nttnProvider?->provider?->name }}</div>
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

            $(document).ready(function() {
                const division = $('#division');
                const districts = JSON.parse('{!! json_encode($districts->toArray()) !!}');
                const upazilas = JSON.parse('{!! json_encode($upazilas->toArray()) !!}');
                const unions = JSON.parse('{!! json_encode($unions->toArray()) !!}');
                {{-- const nttns = JSON.parse('{!! json_encode($nttns->toArray()) !!}'); --}}

                $('#division').change(async function(e) {
                    var divisionId = $(this).val();
                    var districtOptions = '<option value="">Select District</option>';
                    var upazilaOptions = '<option value="">Select Upazila</option>';
                    var unionOptions = '<option value="">Select Union</option>';
                    if (divisionId) {
                        var divisionDistricts = districts.filter(district => district.division_id == divisionId);
                        divisionDistricts.forEach(district => {
                            districtOptions += `<option value="${district.id}">${district.name}</option>`;
                        });
                        $('#district').prop('disabled', false).html(districtOptions);
                        $('#upazila').prop('disabled', true).html(upazilaOptions);
                        $('#union').prop('disabled', true).html(unionOptions);
                    } else {
                        $('#district').prop('disabled', true).html(districtOptions);
                        $('#upazila').prop('disabled', true).html(upazilaOptions);
                        $('#union').prop('disabled', true).html(unionOptions);
                    }
                });

                $('#district').change(async function(e) {
                    var districtId = $(this).val();
                    var upazilaOptions = '<option value="">Select Upazila</option>';
                    var unionOptions = '<option value="">Select Union</option>';
                    if (districtId) {
                        var districtUpazilas = upazilas.filter(upazila => upazila.district_id == districtId);
                        districtUpazilas.forEach(upazila => {
                            upazilaOptions += `<option value="${upazila.id}">${upazila.name}</option>`;
                        });
                        $('#upazila').prop('disabled', false).html(upazilaOptions);
                        $('#union').prop('disabled', true).html(unionOptions);
                    } else {
                        $('#upazila').prop('disabled', true).html(upazilaOptions);
                        $('#union').prop('disabled', true).html(unionOptions);
                    }
                });

                $('#upazila').change(async function(e) {
                    var upazilaId = $(this).val();
                    var unionOptions = '<option value="">Select Union</option>';
                    if (upazilaId) {
                        var upazilaUnions = unions.filter(union => union.upazila_id == upazilaId);
                        upazilaUnions.forEach(union => {
                            unionOptions += `<option value="${union.id}">${union.name}</option>`;
                        });
                        $('#union').prop('disabled', false).html(unionOptions);
                    } else {
                        $('#union').prop('disabled', true).html(unionOptions);
                    }
                });

            });
        </script>
    @endsection
</x-app-layout>
