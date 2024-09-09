@use('\App\Helper\CustomHelper', 'Helper')
<x-app-layout>
    @section('title', 'NDC Appointment')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('NDC Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4 mx-5">
                        <div class="flex justify-center items-center">
                            <p class="font-bold text-gray-600 text-lg">NDC Appointment Details</p>
                        </div>
                        <div class="flex justify-center items-center gap-3">
                            @if ($staff->status != 'Pending')
                                <a target="_blank" href="{{ route('ndc.appointment.print', ['id' => $staff->id]) }}" class="select-none bg-blue-500 hover:bg-blue-700 rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                    <span class="font-bold text-white">Print</span>
                                </a>
                            @endif
                            <a href="{{ route('ndc.appointment.index', ['filter' => request('back_filter')]) }}" class="select-none bg-[#2B7381] hover:bg-[#1e5661] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                <span class="font-bold text-white">Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Name: <span class="font-normal">{{ $staff->user?->name ?? $staff->guest_name }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Organization: <span class="font-normal">{{ $staff->user?->organization ?? $staff->guest_organization }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Designation: <span class="font-normal">{{ $staff->user?->designation ?? $staff->guest_designation }}</span></p>
                        </div>
                        {{-- <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Appointment With: <span class="font-normal">{{ $staff->appoint_mentor }}</span></p>
                        </div> --}}
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Belongs: <span class="font-normal">{{ $staff->belong }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Sector: <span class="font-normal">{{ $staff->sector }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Email: <span class="font-normal">{{ $staff->user?->email ?? $staff->guest_email }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Phone: <span class="font-normal">{{ $staff->user?->phone ?? $staff->guest_phone }}</span></p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Appointment Date & Time: <span class="font-normal">{{ $staff->date . ', ' . $staff->time }}</span></p>
                        </div>
                        @if ($staff->device_model)
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Device model: <span class="font-normal">{{ $staff->device_model }}</span></p>
                            </div>
                        @endif
                        @if ($staff->device_serial)
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Device serial: <span class="font-normal">{{ $staff->device_serial }}</span></p>
                            </div>
                        @endif
                        @if ($staff->device_description)
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Device description: <span class="font-normal">{{ $staff->device_description }}</span></p>
                            </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-600">Status: {!! ['Accepted' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Accepted</span>', 'Pending' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Pending</span>', 'Rejected' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Declined</span> '][$staff->status] !!}</p>
                        </div>
                    </div>

                    <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                        <div class="flex justify-between items-center gap-1">
                            <p class="font-bold text-gray-600">Trasfer this request to another sector: </p><span class="flex justify-center items-center text-xs w-5 h-5 bg-slate-200 rounded-full cursor-default select-none hover:bg-slate-300" title="If the request has been accepted already, it will be reverted to pending if you transfer it to another sector">i</span>
                        </div>
                        <div class="flex justify-between items-center gap-2">
                            <form method="POST" action="{{ route('ndc.appointment.transfer', $staff->id) }}" class="space-y-5">
                                @csrf
                                <div class="">
                                    <x-input-label for="ndc_admin_sector" :value="__('Select Sector')" />
                                    <x-select id="ndc_admin_sector" name="ndc_admin_sector" class="block w-full lg:w-96">
                                        <option value="">Select Sector</option>
                                        <option @selected(in_array(old('ndc_admin_sector'), ['Physical Security & Infrastructure'])) value="Physical Security & Infrastructure">Physical Security & Infrastructure</option>
                                        <option @selected(in_array(old('ndc_admin_sector'), ['Network'])) value="Network">Network</option>
                                        <option @selected(in_array(old('ndc_admin_sector'), ['Co Location'])) value="Co Location">Co Location</option>
                                        <option @selected(in_array(old('ndc_admin_sector'), ['Server & Cloud'])) value="Server & Cloud">Server & Cloud</option>
                                        <option @selected(in_array(old('ndc_admin_sector'), ['Email'])) value="Email">Email</option>
                                    </x-select>
                                    <x-input-error class="mt-2" :messages="$errors->get('ndc_admin_sector')" />
                                </div>
                                <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                    <span class="font-bold text-white">Transfer</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if (Helper::canView('', 'Super Admin|NDC Admin') && $staff->status != 'Rejected')
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                            @if ($staff->document_file != null)
                                <div class="flex justify-between items-center">
                                    <p class="font-bold text-gray-600">Document Uploaded File: <a href="{{ asset($staff->document_file) }}" download="">Download</a></p>
                                </div>
                            @endif
                            <div class="flex justify-between items-center gap-2 mt-2">
                                <form method="POST" action="{{ route('ndc.appointment.upload.document', $staff->id) }}" enctype="multipart/form-data" class="space-y-3">
                                    @csrf
                                    <div>
                                        <x-input-label for="document_file" :value="__('Document')" />
                                        <x-text-input id="document_file" name="document_file" type="file" class="mt-1 block w-full lg:w-96" />
                                        <x-input-error class="mt-2" :messages="$errors->get('document_file')" />
                                    </div>

                                    <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Update</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (Helper::canView('', 'Super Admin|NDC Admin') && $staff->status != 'Rejected')
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-1">
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Update Time Date:</p>
                            </div>
                            <div class="flex justify-between items-center gap-2 mt-2">
                                <form method="POST" action="{{ route('ndc.appointment.edit', $staff->id) }}" class="space-y-3">
                                    @csrf
                                    <div>
                                        <x-input-label for="date" :value="__('Date')" />
                                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full lg:w-96" :value="old('date')" autocomplete="date" />
                                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                                    </div>
                                    <div>
                                        <x-input-label for="time" :value="__('Time')" />
                                        <x-text-input id="time" name="time" type="time" class="mt-1 block w-full lg:w-96" :value="old('time')" autocomplete="time" />
                                        <x-input-error class="mt-2" :messages="$errors->get('time')" />
                                    </div>
                                    <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Update</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if (Helper::canView('Approve NDC Appointment', 'Super Admin') && $staff->status == 'Pending')
                        <div class="mt-6 bg-gray-100 rounded py-5 mx-5 px-6 flex flex-col justify-center items-start gap-2">
                            <div class="flex justify-between items-center">
                                <p class="font-bold text-gray-600">Actions:</p>
                            </div>
                            <div class="flex justify-between items-center gap-2">
                                <form method="GET" action="{{ route('ndc.appointment.approve', $staff->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#2B7381] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Approve</span>
                                    </button>
                                </form>
                                <form method="GET" action="{{ route('ndc.appointment.decline', $staff->id) }}">
                                    @csrf
                                    <button type="submit" class="select-none bg-[#FF4D4D] rounded shadow-md flex justify-center items-center flex-col gap-2 transition-shadow hover:shadow-lg p-2 px-6">
                                        <span class="font-bold text-white">Decline</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
