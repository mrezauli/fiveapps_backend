<x-app-layout>
    @section('title', 'Staff Hierarchy Assign')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Hierarchy Assign') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 w-full">
                    <form id="hierarchy-form" action="{{ url()->current() }}" data-submittable="false" method="POST" class="space-y-4 flex justify-center items-center flex-col">
                        @csrf
                        <div class="flex justify-center items-center flex-col w-[60%] relative">
                            <x-select id="senior_officer" name="senior_officer" class="w-full block" required>
                                <option value="">Select Senior Officer</option>
                                @foreach ($senior_staffs as $senior_staff)
                                    <option value="{{ $senior_staff->id }}">{{ $senior_staff->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('senior_officer')" />
                        </div>
                        <input type="hidden" name="junior_staff" id="hidden_junior_staff">
                        <div class="flex justify-center items-center flex-col w-[60%] relative">
                            <x-select id="junior_staff" multiple="multiple" class="staffs-selector w-full block">
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('junior_staff')" />
                            <div id="progress" class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-10 hidden justify-center items-center rounded-md z-10">
                                <i class="fa-solid fa-spinner text-indigo-500 animate-spin"></i>
                            </div>
                        </div>
                        <x-primary-button>{{ __('Assign') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).on('change', '#senior_officer', async function(e) {
                e.preventDefault();
                $('#progress').removeClass('hidden').addClass('flex');
                $('#junior_staff').empty();
                if (e.target.value == '') {
                    $('#progress').removeClass('flex').addClass('hidden');
                    return;
                }
                const url = "{{ route('vm.staff-hierarchy.staffs') }}";
                let data = [];
                data = await $.get(url, {
                    'seniorId': e.target.value
                });
                const allJuniors = data.allJuniors;
                let juniorStaffs = data.juniorStaffs;
                juniorStaffs = juniorStaffs.map(junior => parseInt(junior));
                console.log(juniorStaffs);

                for (let i = 0; i < allJuniors.length; i++) {
                    if (juniorStaffs.includes(allJuniors[i].id)) {
                        $('#junior_staff').append(`<option value="${allJuniors[i].id}" selected>${allJuniors[i].name}</option>`);
                    } else {
                        $('#junior_staff').append(`<option value="${allJuniors[i].id}">${allJuniors[i].name}</option>`);
                    }
                }
                $('#progress').removeClass('flex').addClass('hidden');
            });

            $('#junior_staff').select2({
                placeholder: "Select junior staffs",
                width: 'resolve',
            });
            
            $(document).on('change', '#junior_staff', function(e) {
                $('#hidden_junior_staff').val($('#junior_staff').val().join(','));
            });
        </script>
    @endsection
</x-app-layout>
