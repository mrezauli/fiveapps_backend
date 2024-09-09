<x-app-layout>
    @section('title', 'BCC Staffs')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List of Role</h1>
                        <a href="{{ route('role.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded">Add new role</a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 mt-5">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>

                                <th class="px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items
                                            -center">
                                            <div>
                                                <div class="text-sm leading-5 font-medium text-gray-900"> {{ $role->name }} </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex justify-end items-center gap-2">
                                        <a href="{{ route('role.edit', ['id' => $role->id]) }}" class="text-blue-600 hover:text-bule-900 hover:underline">Edit</a>
                                        <a href="{{ route('role.delete', ['id' => $role->id]) }}" class="text-red-600 hover:text-red-900 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- $users->links() --}}
                    {{--  --}}
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
