@use('App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'Edit NTTN Data')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit NTTN Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit NTTN Data</p>
                    </div>
                    <a href="{{ route('nttn.view', $nttn->id) }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ url()->current() }}" method="POST" class="space-y-4">
                        @csrf
                        {{-- Region ->> --}}
                        <div>
                            <x-input-label for="division" :value="__('Division')" />
                            <x-select id="division" name="division_id" class="mt-1 block w-full" required>
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" @selected($division->id == $nttn->union?->upazila?->district?->division?->id)>{{ $division->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('division_id')" />
                        </div>
                        <div>
                            <x-input-label for="district" :value="__('District')" />
                            <x-select id="district" name="district_id" :disabled="true" class="mt-1 block w-full" required>
                                <option value="{{ $nttn->union?->upazila?->district?->id }}">{{ $nttn->union?->upazila?->district?->name }}</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('district_id')" />
                        </div>
                        <div>
                            <x-input-label for="upazila" :value="__('Upazila')" />
                            <x-select id="upazila" name="upazila_id" :disabled="true" class="mt-1 block w-full" required>
                                <option value="{{ $nttn->union?->upazila?->id }}">{{ $nttn->union?->upazila?->name }}</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('upazila_id')" />
                        </div>
                        <div>
                            <x-input-label for="union" :value="__('Union')" />
                            <x-select id="union" name="union_id" :disabled="true" class="mt-1 block w-full" required>
                                <option value="{{ $nttn->union?->id }}">{{ $nttn->union?->name }}</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('union_id')" />
                        </div>
                        {{-- <<- Region --}}
                        <div>
                            <x-input-label for="phone" :value="__('Phone number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $nttn->phone)" required autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="pop_location" :value="__('Pop location')" />
                            <x-text-input id="pop_location" name="pop_location" type="text" class="mt-1 block w-full" :value="old('pop_location', $nttn->pop_location)" required autocomplete="pop_location" />
                            <x-input-error class="mt-2" :messages="$errors->get('pop_location')" />
                        </div>
                        <div>
                            <x-input-label for="pop_location_type" :value="__('Pop location type')" />
                            <x-text-input id="pop_location_type" name="pop_location_type" type="text" class="mt-1 block w-full" :value="old('pop_location_type', $nttn->pop_location_type)" required autocomplete="pop_location_type" />
                            <x-input-error class="mt-2" :messages="$errors->get('pop_location_type')" />
                        </div>
                        @php
                            $myRole = Helper::userRoleName(auth()->user());
                        @endphp
                        @if ($myRole == 'Super Admin')
                            @php
                                $providers = \App\Models\NttnProvider::select('id', 'name', 'slug')->get();
                            @endphp
                            <div>
                                <x-input-label for="nttn" :value="__('NTTN')" />
                                <x-select id="nttn" name="nttn_id" class="mt-1 block w-full" required>
                                    <option value="">Select NTTN</option>
                                    @foreach ($providers as $nn)
                                        <option value="{{ $nn->id }}" @selected($nttn->nttn_providerId == $nn->id)>{{ $nn->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('nttn_id')" />
                            </div>
                        @endif
                        {{-- <div>
                            <x-input-label for="nttn" :value="__('NTTN')" />
                            <x-select id="nttn" name="nttn" class="mt-1 block w-full" required>
                                <option value="">Select NTTN</option>
                                @foreach ($providers as $nt)
                                    <option value="{{ $nt->id }}" @selected($nttn->nttn_providerId == $nt->id)>{{ $nt->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('nttn')" />
                        </div> --}}
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
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
    @endsection
</x-app-layout>