@use('App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'Create new NTTN Staff')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new NTTN Staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('nttn_staff.save') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email address')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('Phone number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full" :value="old('designation')" required autocomplete="designation" />
                            <x-input-error class="mt-2" :messages="$errors->get('designation')" />
                        </div>
                        {{-- Region ->> --}}
                        <div>
                            <x-input-label for="division" :value="__('Division')" />
                            <x-select id="division" name="division_id" class="mt-1 block w-full" required>
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('division_id')" />
                        </div>
                        <div>
                            <x-input-label for="district" :value="__('District')" />
                            <x-select id="district" name="district_id" :disabled="true" class="mt-1 block w-full" required>
                                <option value="">Select District</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('district_id')" />
                        </div>
                        <div>
                            <x-input-label for="upazila" :value="__('Upazila')" />
                            <x-select id="upazila" name="upazila_id" :disabled="true" class="mt-1 block w-full" required>
                                <option value="">Select Upazila</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('upazila_id')" />
                        </div>
                        <div>
                            <x-input-label for="union" :value="__('Union')" />
                            <x-select id="union" name="union_id" :disabled="true" class="mt-1 block w-full" required>
                                <option value="">Select Union</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('union_id')" />
                        </div>
                        {{-- <<- Region --}}
                        @php
                            $myRole = Helper::userRoleName(auth()->user());
                        @endphp
                        @if ($myRole == 'Super Admin')
                            @php
                                $providers = \App\Models\NttnProvider::select('id', 'name', 'slug')->get();
                            @endphp
                            <div>
                                <x-input-label for="provider" :value="__('Provider')" />
                                <x-select id="provider" name="provider_slug" class="mt-1 block w-full" required>
                                    <option value="">Select Provider</option>
                                    @foreach ($providers as $nttn)
                                        <option value="{{ $nttn->slug }}">{{ $nttn->name }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('provider_slug')" />
                            </div>
                        @endif
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('New Password')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :value="old('password')" required autocomplete="password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="confirm_password" :value="__('Confirm Password')" />
                            <x-text-input id="confirm_password" name="confirm_password" type="password" class="mt-1 block w-full" :value="old('confirm_password')" required autocomplete="confirm_password" />
                            <x-input-error class="mt-2" :messages="$errors->get('confirm_password')" />
                        </div>
                        <x-primary-button>{{ __('Create') }}</x-primary-button>
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
