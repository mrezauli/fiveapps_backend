<x-app-layout>
    @section('title', 'Edit NDC User')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit NDC User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center mb-4 mx-5 pt-6">
                    <div class="flex justify-center items-center">
                        <p class="font-bold text-gray-600 text-lg">Edit NDC User</p>
                    </div>
                    <a href="{{ route('ndc.user.view', $staff->id) }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                        <span class="font-bold text-white">Back</span>
                    </a>
                </div>
                <div class="p-6 pt-0 text-gray-900 max-w-xl">
                    <form action="{{ route('ndc.user.store') }}" method="POST" class="space-y-4">
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
                            <x-input-label for="organization" :value="__('Organization')" />
                            <x-text-input id="organization" name="organization" type="text" class="mt-1 block w-full" :value="old('organization', $staff->organization)" required autocomplete="organization" />
                            <x-input-error class="mt-2" :messages="$errors->get('organization')" />
                        </div>


                        <div>
                            <x-input-label for="designation" :value="__('Designation')" />
                            <x-text-input id="designation" name="designation" type="text" class="mt-1 block w-full" :value="old('designation', $staff->designation)" required autocomplete="designation" />
                            <x-input-error class="mt-2" :messages="$errors->get('designation')" />
                        </div>

                        <div>
                            <x-input-label for="user_type" :value="__('User Type')" />
                            <x-select id="user_type" name="user_type" class="mt-1 block w-full" required>
                                <option value="">Select User Type</option>
                                <option @selected(in_array(old('user_type', $staff->user_type), ['ndc_admin'])) value="ndc_admin">NDC Admin</option>
                                <option @selected(in_array(old('user_type', $staff->user_type), ['ndc_security_admin'])) value="ndc_security_admin">NDC Security Admin</option>
                                <optgroup label="Visitor">
                                    <option @selected(in_array(old('user_type', $staff->user_type), ['ndc_internal'])) value="ndc_internal">Internal</option>
                                    <option @selected(in_array(old('user_type', $staff->user_type), ['ndc_customer'])) value="ndc_customer">Customer</option>
                                    <option @selected(in_array(old('user_type', $staff->user_type), ['ndc_vendor'])) value="ndc_vendor">Vendor</option>
                                </optgroup>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('user_type')" />
                        </div>

                        <div id="sector_container" class="{{ old('ndc_admin_sector') || $staff->ndc_admin_sector ? 'block' : 'hidden' }}">
                            <x-input-label for="ndc_admin_sector" :value="__('Sector')" />
                            <x-select id="ndc_admin_sector" name="ndc_admin_sector" class="mt-1 block w-full" :disabled="old('ndc_admin_sector') || $staff->ndc_admin_sector ? false : true">
                                <option value="">Select Sector</option>
                                <option @selected(in_array(old('ndc_admin_sector', $staff->ndc_admin_sector), ['Physical Security & Infrastructure'])) value="Physical Security & Infrastructure">Physical Security & Infrastructure</option>
                                <option @selected(in_array(old('ndc_admin_sector', $staff->ndc_admin_sector), ['Network'])) value="Network">Network</option>
                                <option @selected(in_array(old('ndc_admin_sector', $staff->ndc_admin_sector), ['Co Location'])) value="Co Location">Co Location</option>
                                <option @selected(in_array(old('ndc_admin_sector', $staff->ndc_admin_sector), ['Server & Cloud'])) value="Server & Cloud">Server & Cloud</option>
                                <option @selected(in_array(old('ndc_admin_sector', $staff->ndc_admin_sector), ['Email'])) value="Email">Email</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('ndc_admin_sector')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option @selected(in_array(old('status', $staff->active), ['1'])) value="1">Active</option>
                                <option @selected(in_array(old('status', $staff->active), ['0'])) value="0">Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('New Password')" />
                            <x-text-input id="password" name="password" type="text" class="mt-1 block w-full" :value="old('password')"  autocomplete="password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div>
                            <x-input-label for="confirm_password" :value="__('Confirm Password')" />
                            <x-text-input id="confirm_password" name="confirm_password" type="text" class="mt-1 block w-full" :value="old('confirm_password')"  autocomplete="confirm_password" />
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
            $('#user_type').on('change', function() {
                if (this.value == 'ndc_admin') {
                    $('#sector_container').slideDown();
                    $('#ndc_admin_sector').removeAttr('disabled');
                } else {
                    $('#sector_container').slideUp();
                    $('#ndc_admin_sector').attr('disabled', true);
                    $('#ndc_admin_sector').val('');
                }
            });
        </script>
    @endsection
</x-app-layout>