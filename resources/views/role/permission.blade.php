<x-app-layout>
    @section('title', 'Manage Permission')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="flex flex-col gap-4 lg:gap-5 p-6.5" action="{{ route('permission.manage') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-5">
                            <div class="col-span-full">
                                <label for="link_type" class="mb-3 cursor-pointer block font-medium text-sm text-muted">
                                    {{ __('Role') }}
                                </label>
                                <x-select name="role" class="mt-1 block w-full" required>
                                    <option value="">Choose a Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ encrypt($role->id) }}" class="text-capitalize">{{ $role->name }}</option>
                                    @endforeach
                                </x-select>
                                @error('role')
                                    <strong class="text-red-600"> {{ $errors->first('role') }} </strong>
                                @enderror
                            </div>
                            <div class="col-span-2" id="permissions">

                            </div>
                        </div>
                        <div class="flex lg:flex-row flex-col-reverse items-center gap-5.5 lg:justify-end">
                            <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold cursor-pointer text-sm py-3 px-6 rounded" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="mx-auto flex flex-col gap-9">
        <div class="rounded border border-stroke bg-white shadow-default ">
            <form class="flex flex-col gap-4 lg:gap-5 p-6.5" action="{{ route('permission.manage') }}" method="post">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-5">
                    <div class="col-span-full">
                        <label for="link_type" class="mb-3 cursor-pointer block font-medium text-sm text-muted">
                            {{ __('Role') }}
                        </label>
                        <select name="role" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:ring-primary focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" required>
                            <option value="">Choose a Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ encrypt($role->id) }}" class="text-capitalize">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <strong class="text-red-600"> {{ $errors->first('role') }} </strong>
                        @enderror
                    </div>
                    <div class="col-span-2" id="permissions">

                    </div>
                </div>
                <div class="flex lg:flex-row flex-col-reverse items-center gap-5.5 lg:justify-end">
                    <input type="submit" value="Submit" class="w-full lg:w-1/4 cursor-pointer rounded-lg border border-primary-light bg-blue-700 hover:!bg-primary transition-transform active:scale-95 p-4 font-medium text-lime-50" />
                </div>
            </form>
        </div>
    </div> --}}
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('select[name="role"]').on('change', function() {
                    // role id
                    const roleId = $(this).val();
                    let output = "";
                    let permissions = JSON.parse('{!! $permissions !!}');
                    if (roleId !== "") {
                        // get all permission based on role id
                        $.ajax({
                            url: "{{ route('get.permission.by.role') }}",
                            method: "POST",
                            dataType: "json",
                            data: {
                                role_id: roleId
                            },
                            success: function(currentPermissions) {
                                if (currentPermissions.length > 0) {
                                    $.each(permissions, function(i, e) {
                                        output += '<p class="mb-3 cursor-pointer block font-medium text-sm text-muted">';
                                        output += i;
                                        output += '</p>';
                                        output += '<div class="flex gap-3 flex-wrap">';

                                        $.each(e, function(ii, ee) {
                                            if (hasPermission(currentPermissions, ee.id)) {
                                                output += '<label class="text-xs lg:text-sm relative rounded-full border overflow-hidden cursor-pointer">';
                                                output += '<input class="absolute opacity-0 peer childCheckbox" type="checkbox" name="permission[]" value="' + ee.id + '" checked>';
                                                output += '<span class="block py-1 px-4 select-none peer-checked:bg-teal-500 peer-checked:text-white"> ' + ee.name.replace(/_/g, " ") + ' </span>';
                                                output += '</label>';
                                            } else {
                                                output += '<label class="text-xs lg:text-sm relative rounded-full border overflow-hidden cursor-pointer">';
                                                output += '<input class="absolute opacity-0 peer childCheckbox" type="checkbox" name="permission[]" value="' + ee.id + '">';
                                                output += '<span class="block py-1 px-4 select-none peer-checked:bg-teal-500 peer-checked:text-white"> ' + ee.name.replace(/_/g, " ") + ' </span>';
                                                output += '</label>';
                                            }
                                        })
                                        output += '</div>';
                                    })

                                    $('#permissions').html(output);

                                } else { // output all the permission without checked
                                    $.each(permissions, function(i, e) {
                                        output += '<p class="mb-3 cursor-pointer block font-medium text-sm text-muted">';
                                        output += i;
                                        output += '</p>';
                                        output += '<div class="flex gap-3 flex-wrap">';
                                        $.each(e, function(ii, ee) {
                                            output += '<label class="text-xs lg:text-sm relative rounded-full border overflow-hidden cursor-pointer">';
                                            output += '<input class="absolute opacity-0 peer childCheckbox" type="checkbox" name="permission[]" value="' + ee.id + '">';
                                            output += '<span class="block py-1 px-4 select-none peer-checked:bg-teal-500 peer-checked:text-white"> ' + ee.name.replace(/_/g, " ") + ' </span>';
                                            output += '</label>';
                                        })
                                        output += '</div>';
                                    })
                                    $('#permissions').html(output);
                                }
                            }
                        })
                    }
                })

                // checks if the user has permission
                function hasPermission(currentPermissions, permissionId) {
                    let ret = false;
                    $.each(currentPermissions, function(i, e) {
                        if (Number(e.id) === Number(permissionId)) {
                            ret = true
                        }
                    })
                    return ret;
                }
            });
        </script>
    @endsection
</x-app-layout>
