<x-app-layout>
    @section('title', 'Add new car assign information')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new car assign information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('vm.cars.assign.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="driver" :value="__('Driver')" />
                            <x-select id="driver" name="driver" class="mt-1 block w-full" required>
                                <option selected value="">Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('driver')" />
                        </div>

                        <div>
                            <x-input-label for="car" :value="__('Car')" />
                            <x-select id="car" name="car" class="mt-1 block w-full" required>
                                <option selected value=""> Select Car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('car')" />
                        </div>
                        <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>