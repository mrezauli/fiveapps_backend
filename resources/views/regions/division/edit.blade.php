<x-app-layout>
    @section('title', 'Edit Division')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Division') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit Division</p>
                    </div>
                    <a href="{{ route('regions.division.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ url()->current() }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name_en" :value="__('Name (en)')" />
                            <x-text-input id="name_en" name="name_en" type="text" class="mt-1 block w-full" :value="old('name_en', $division->name)" required autofocus autocomplete="name_en" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_en')" />
                        </div>
                        <div>
                            <x-input-label for="name_bn" :value="__('Name (bn)')" />
                            <x-text-input id="name_bn" name="name_bn" type="text" class="mt-1 block w-full" :value="old('name_bn', $division->bn_name)" required autofocus autocomplete="name_bn" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_bn')" />
                        </div>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @section('scripts')
        <script>
            $(document).ready(function() {
                const division = $('#division');
                const districts = JSON.parse('{!! json_encode($districts->toArray()) !!}');
                const upazilas = JSON.parse('{!! json_encode($upazilas->toArray()) !!}');
                const unions = JSON.parse('{!! json_encode($unions->toArray()) !!}');
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
    @endsection --}}
</x-app-layout>
