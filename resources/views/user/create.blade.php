<x-app-layout>
    @section('title', 'Create new User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
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
                            <x-input-label for="role" :value="__('Role')" />
                            <x-select id="role" name="role" class="mt-1 block w-full" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('role')" />
                        </div>
                        <div id="provider_div" class="{{ old('role') ? (starts_with(getRoleNameById(old('role')), 'NTTN') ? 'block' : 'hidden') : 'hidden' }}">
                            <x-input-label for="provider" :value="__('Provider')" />
                            <x-select id="provider" name="provider_slug" class="mt-1 block w-full" :disabled="old('role') ? (starts_with(getRoleNameById(old('role')), 'NTTN') ? false : true) : true" required>
                                <option value="">Select Provider</option>
                                @foreach ($providers as $nttn)
                                    <option value="{{ $nttn->slug }}" @checked(old('provider_slug') == $nttn->slug)>{{ $nttn->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('provider_slug')" />
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
