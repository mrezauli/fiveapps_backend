<x-app-layout>
    @section('title', 'Add new Upazila')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new Upazila') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="name_en" :value="__('Name (en)')" />
                            <x-text-input id="name_en" name="name_en" type="text" class="mt-1 block w-full" :value="old('name_en')" required autofocus autocomplete="name_en" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_en')" />
                        </div>
                        <div>
                            <x-input-label for="name_bn" :value="__('Name (bn)')" />
                            <x-text-input id="name_bn" name="name_bn" type="text" class="mt-1 block w-full" :value="old('name_bn')" required autofocus autocomplete="name_bn" />
                            <x-input-error class="mt-2" :messages="$errors->get('name_bn')" />
                        </div>
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
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
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
                    } else {
                        $('#district').prop('disabled', true).html(districtOptions);
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>