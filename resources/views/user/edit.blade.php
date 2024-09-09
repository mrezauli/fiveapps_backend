<x-app-layout>
    @section('title', 'Edit User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit User</p>
                    </div>
                    <a href="{{ route('user.index') }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $staff->id }}">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $staff->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email address')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $staff->email)" required autocomplete="email" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('Phone number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $staff->phone)" required autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full" :value="old('designation', $staff->designation)" required autocomplete="designation" />
                            <x-input-error class="mt-2" :messages="$errors->get('designation')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option @selected($staff->active == 1) value="active">Active</option>
                                <option @selected($staff->active == 0) value="inactive">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <div>
                            <x-input-label for="role" :value="__('Role')" />
                            <x-select id="role" name="role" class="mt-1 block w-full" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option @selected($roleName == $role->name) value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>

                        @php
                            // $roleIdName = getRoleNameById($roleName);
                            $isNttn = starts_with($staff->user_type ?? '', 'nttn');
                            if ($isNttn) {
                                $nttnProvider = getNttnProvider($staff);
                                // dd($nttnProvider);
                            }
                        @endphp

                        <div id="provider_div" class="{{ old('role') ? (starts_with(getRoleNameById(old('role')), 'NTTN') ? 'block' : 'hidden') : ($isNttn ? 'block' : 'hidden') }}">
                            <x-input-label for="provider" :value="__('Provider')" />
                            <x-select id="provider" name="provider_slug" class="mt-1 block w-full" :disabled="old('role') ? (starts_with(getRoleNameById(old('role')), 'NTTN') ? false : true) : ($isNttn ? false : false)" required>
                                <option value="">Select Provider</option>
                                @foreach ($providers as $nttn)
                                    <option value="{{ $nttn->slug }}" @selected(old('provider_slug') ? old('provider_slug') == $nttn->slug : ($isNttn ? $nttnProvider->slug == $nttn->slug : false))>{{ $nttn->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('provider_slug')" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('New Password')" />
                            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full" :value="old('password')" required autocomplete="password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="confirm_password" :value="__('Confirm Password')" />
                            <x-text-input id="confirm_password" name="confirm_password" type="text" class="mt-1 block w-full" :value="old('confirm_password')" required autocomplete="confirm_password" />
                            <x-input-error class="mt-2" :messages="$errors->get('confirm_password')" />
                        </div>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $('#role').change((e) => {
                const selectedRole = $('#role  option:selected').text();
                if (selectedRole === 'NTTN Staff' || selectedRole === 'NTTN') {
                    // $('#provider_div').slideIn('fast');
                    $('#provider_div').slideDown('fast');
                    $('#provider').prop('disabled', false);
                } else {
                    // $('#provider_div').slideOut('fast');
                    $('#provider_div').slideUp('fast');
                    $('#provider').prop('disabled', true);
                    $('#provider').val('');
                }
            })
        </script>
    @endsection
</x-app-layout>
