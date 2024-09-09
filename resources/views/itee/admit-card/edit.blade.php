<x-app-layout>
    @section('title', 'Edit Admit Card')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Admit Card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.admit-card.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ac_data->id }}">
                        <div>
                            <x-input-label for="name" :value="__('Student')" />
                            <x-select id="name" name="name" class="mt-1 block w-full">
                                <option value="">Select Student</option>
                                @php
                                    $estudents = \App\Models\IteeExamRegistration::where('status', 1)->where('payment', 'Paid')->select('full_name')->distinct()->get();
                                @endphp
                                @foreach ($estudents as $student)
                                    <option value="{{ $student->full_name }}" @selected(old_with('name', $student->full_name, $ac_data->name))>{{ $student->full_name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="examine_id" :value="__('Examine Id')" />
                            <x-select id="examine_id" name="examine_id" class="mt-1 block w-full disabled:cursor-not-allowed">
                                @php
                                    $exids = \App\Models\IteeExamRegistration::where('status', 1)
                                        ->where('payment', 'Paid')
                                        ->where('full_name', $ac_data->name)
                                        ->select('examine_id')
                                        ->get();
                                @endphp
                                <option value="">Select Examine Id</option>
                                @foreach ($exids as $exid)
                                    <option value="{{ $exid->examine_id }}" @selected(old_with('examine_id', $exid->examine_id, $ac_data->examine_id))>{{ $exid->examine_id }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('examine_id')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $ac_data->email)" autocomplete="email" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $ac_data->phone)" autocomplete="phone" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-textarea id="address" name="address" type="text" class="mt-1 block w-full" autocomplete="address" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly>{{ old('address', $ac_data->address) }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div>
                            <x-input-label for="sex" :value="__('Sex')" />
                            <x-text-input id="sex" name="sex" type="text" class="mt-1 block w-full" :value="old('sex', $ac_data->sex)" autocomplete="sex" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('sex')" />
                        </div>
                        <div>
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" name="dob" type="text" class="mt-1 block w-full" :value="old('dob', $ac_data->dob)" autocomplete="dob" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div>
                            <x-input-label for="pin" :value="__('PIN')" />
                            <x-text-input id="pin" name="pin" type="number" class="mt-1 block w-full" :value="old('pin', $ac_data->pin)" autocomplete="pin" />
                            <x-input-error class="mt-2" :messages="$errors->get('pin')" />
                        </div>
                        {{-- <div>
                            <x-input-label for="area" :value="__('Area')" />
                            <x-text-input id="area" name="area" type="text" class="mt-1 block w-full" :value="old('area', $ac_data->area)" autocomplete="area" />
                            <x-input-error class="mt-2" :messages="$errors->get('area')" />
                        </div> --}}
                        <div>
                            <x-input-label for="area_id" :value="__('Area')" />
                            <x-select id="area_id" name="area_id" class="mt-1 block w-full">
                                <option>Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @selected(old_with('area_id', $area->id, $ac_data->area_id))>{{ $area->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('area_id')" />
                        </div>
                        <div>
                            <x-input-label for="site" :value="__('Site')" />
                            <x-text-input id="site" name="site" type="text" class="mt-1 block w-full" :value="old('site', $ac_data->site)" autocomplete="site" />
                            <x-input-error class="mt-2" :messages="$errors->get('site')" />
                        </div>
                        <div>
                            <x-input-label for="room_no" :value="__('Room no')" />
                            <x-text-input id="room_no" name="room_no" type="text" class="mt-1 block w-full" :value="old('room_no', $ac_data->room_no)" autocomplete="room_no" />
                            <x-input-error class="mt-2" :messages="$errors->get('room_no')" />
                        </div>
                        <div>
                            <x-input-label for="post_code" :value="__('Post Code')" />
                            <x-text-input id="post_code" name="post_code" type="text" class="mt-1 block w-full" :value="old('post_code', $ac_data->post_code)" autocomplete="post_code" />
                            <x-input-error class="mt-2" :messages="$errors->get('post_code')" />
                        </div>
                        <div>
                            <x-input-label for="exempt" :value="__('Exempt')" />
                            <x-text-input id="exempt" name="exempt" type="text" class="mt-1 block w-full" :value="old('exempt', $ac_data->exempt)" autocomplete="exempt" />
                            <x-input-error class="mt-2" :messages="$errors->get('exempt')" />
                        </div>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            const dataArray = JSON.parse(`{!! json_encode($students->select('examine_id', 'full_name', 'email', 'phone', 'gender', 'address', 'dob')->get()) !!}`);
            $('#name').change(function(e) {
                const name = e.target.value;
                const examineIds = getExamineIds(name);
                $('#email').val('');
                $('#phone').val('');
                $('#address').val('');
                $('#sex').val('');
                $('#dob').val('');
                if (examineIds.length > 0) {
                    $('#examine_id').empty();
                    $('#examine_id').prop('disabled', false);
                    $('#examine_id').append(`<option value="">Select Examine Id</option>`);

                    examineIds.forEach((elm) => {
                        $('#examine_id').append(`<option value="${elm.examine_id}">${elm.examine_id}</option>`);
                    })
                } else {
                    $('#examine_id').empty();
                    $('#examine_id').prop('disabled', true);
                    $('#examine_id').append(`<option value="">Select Examine Id</option>`);
                }
            });

            $('#examine_id').change(function(e) {
                const examine_id = e.target.value;
                if (!examine_id) {
                    $('#email').val('');
                    $('#phone').val('');
                    $('#address').val('');
                    $('#sex').val('');
                    $('#dob').val('');
                    return;
                }
                const fdata = findData(examine_id);

                const email = fdata.email;
                const phone = fdata.phone;
                const address = fdata.address;
                const sex = fdata.gender === 'Male' || fdata.gender === 'M' ? 'Male' : 'Female';
                const dob = fdata.dob;


                $('#email').val(email);
                $('#phone').val(phone);
                $('#address').val(address);
                $('#sex').val(sex);
                $('#dob').val(dob);
            });

            function getExamineIds(name) {
                const student = dataArray.filter((data) => data.full_name === name);
                return student;
            }

            function findData(examine_id) {
                const student = dataArray.find((data) => data.examine_id === examine_id);
                return student;
            }
        </script>
    @endsection
</x-app-layout>
