<x-app-layout>
    @section('title', 'Add new Admit Card')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new Admit Card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.admit-card.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Student')" />
                            <x-select id="name" name="name" class="mt-1 block w-full" required>
                                <option>Select Student</option>
                                @php
                                    $estudents = $students->select('full_name')->distinct()->get();
                                @endphp
                                @foreach ($estudents as $student)
                                    <option value="{{ $student->full_name }}" @selected(old('name') && old('name') == $student->full_name ? true : false)>{{ $student->full_name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="examine_id" :value="__('Examine Id')" />
                            <x-select id="examine_id" name="examine_id" class="mt-1 block w-full disabled:cursor-not-allowed" required disabled>
                                <option>Select Examine Id</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('examine_id')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email')" required autocomplete="email" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required autocomplete="phone" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-textarea id="address" name="address" type="text" class="mt-1 block w-full" required autocomplete="address" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly>{{ old('address') }}</x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div>
                            <x-input-label for="sex" :value="__('Sex')" />
                            <x-text-input id="sex" name="sex" type="text" class="mt-1 block w-full" :value="old('sex')" required autocomplete="sex" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('sex')" />
                        </div>
                        <div>
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" name="dob" type="text" class="mt-1 block w-full" :value="old('dob')" required autocomplete="dob" class="read-only:bg-gray-100 w-full read-only:cursor-not-allowed read-only:text-gray-600" readonly />
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div>
                            <x-input-label for="pin" :value="__('PIN')" />
                            <x-text-input id="pin" name="pin" type="number" class="mt-1 block w-full" :value="old('pin')" required autocomplete="pin" />
                            <x-input-error class="mt-2" :messages="$errors->get('pin')" />
                        </div>
                        <div>
                            <x-input-label for="area_id" :value="__('Area')" />
                            <x-select id="area_id" name="area_id" class="mt-1 block w-full" required>
                                <option>Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @selected(old('area_id') && old('area_id') == $area->id ? true : false)>{{ $area->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('area_id')" />
                        </div>
                        {{-- <div>
                            <x-input-label for="area" :value="__('Area')" />
                            <x-text-input id="area" name="area" type="text" class="mt-1 block w-full" :value="old('area')" required autocomplete="area" />
                            <x-input-error class="mt-2" :messages="$errors->get('area')" />
                        </div> --}}
                        <div>
                            <x-input-label for="site" :value="__('Site')" />
                            <x-text-input id="site" name="site" type="text" class="mt-1 block w-full" :value="old('site')" required autocomplete="site" />
                            <x-input-error class="mt-2" :messages="$errors->get('site')" />
                        </div>
                        <div>
                            <x-input-label for="room_no" :value="__('Room no')" />
                            <x-text-input id="room_no" name="room_no" type="text" class="mt-1 block w-full" :value="old('room_no')" required autocomplete="room_no" />
                            <x-input-error class="mt-2" :messages="$errors->get('room_no')" />
                        </div>
                        <div>
                            <x-input-label for="post_code" :value="__('Post Code')" />
                            <x-text-input id="post_code" name="post_code" type="text" class="mt-1 block w-full" :value="old('post_code')" required autocomplete="post_code" />
                            <x-input-error class="mt-2" :messages="$errors->get('post_code')" />
                        </div>
                        <div>
                            <x-input-label for="exempt" :value="__('Exempt')" />
                            <x-text-input id="exempt" name="exempt" type="text" class="mt-1 block w-full" :value="old('exempt')" required autocomplete="exempt" />
                            <x-input-error class="mt-2" :messages="$errors->get('exempt')" />
                        </div>
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
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
                    $('#examine_id').append(`<option>Select Examine Id</option>`);

                    examineIds.forEach((elm) => {
                        $('#examine_id').append(`<option value="${elm.examine_id}">${elm.examine_id}</option>`);
                    })
                } else {
                    $('#examine_id').empty();
                    $('#examine_id').prop('disabled', true);
                    $('#examine_id').append(`<option>Select Examine Id</option>`);
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

            // function getEmail(examine_id) {
            //     const student = dataArray.find((data) => data.examine_id === examine_id);
            //     return student.email;
            // }

            // function getPhone(examine_id) {
            //     const student = dataArray.find((data) => data.examine_id === examine_id);
            //     return student.phone;
            // }

            // function getGender(examine_id) {
            //     const student = dataArray.find((data) => data.examine_id === examine_id);
            //     return student.gender === 'Male' ? 'Male' : 'Female';
            // }

            // function getAddress(examine_id) {
            //     const student = dataArray.find((data) => data.examine_id === examine_id);
            //     return student.address;
            // }

            // function getDOB(examine_id) {
            //     const student = dataArray.find((data) => data.examine_id === examine_id);
            //     return student.dob;
            // }
        </script>
    @endsection
</x-app-layout>
