<x-app-layout>
    @section('title', 'Edit car information')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit car information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('vm.cars.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $car->id }}">
                        <div>
                            <x-input-label for="car_name" :value="__('Car name')" />
                            <x-text-input id="car_name" name="car_name" type="text" class="mt-1 block w-full" :value="old('car_name', $car->name)" required autocomplete="car_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('car_name')" />
                        </div>
                        <div>
                            <x-input-label for="model_number" :value="__('Model number')" />
                            <x-text-input id="model_number" name="model_number" type="text" class="mt-1 block w-full" :value="old('model_number', $car->model_number)" required autocomplete="model_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('model_number')" />
                        </div>
                        <div>
                            <x-input-label for="vehicle_number" :value="__('Vehicle number')" />
                            <x-text-input id="vehicle_number" name="vehicle_number" type="text" class="mt-1 block w-full" :value="old('vehicle_number', $car->vehicle_number)" required autocomplete="vehicle_number" />
                            <x-input-error class="mt-2" :messages="$errors->get('vehicle_number')" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="">Select Status</option>
                                <option value="1" @selected((old('status') && old('status') == 1 ? true : false) || ($car->status == 1 ? true : false))>Active</option>
                                <option value="0" @selected((old('status') && old('status') == 0 ? true : false) || ($car->status == 0 ? true : false))>Inactive</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
