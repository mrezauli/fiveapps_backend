<x-guest-layout>
    <form method="POST" action="{{ route('examinee.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mobile Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Mobile Number')" />
            <x-text-input id="phone" class="block w-full mt-1" type="text" name="phone" :value="old('phone')"
                required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- <!-- Occupation -->
            <div>
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input id="occupation" class="block w-full mt-1" type="text" name="occupation"
                    :value="old('occupation')" required autofocus autocomplete="occupation" />
                <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
            </div>

            <!-- LinkedIn Profile -->
            <div>
                <x-input-label for="linkedin" :value="__('LinkedIn Profile')" />
                <x-text-input id="linkedin" class="block w-full mt-1" type="text" name="linkedin" :value="old('linkedin')"
                    required autofocus autocomplete="linkedin" />
                <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
            </div>

            <!-- Profile Picture -->
            <div>
                <x-input-label for="photo" :value="__('Add Profile Picture')" />
                <x-text-input id="photo" class="block w-full mt-1" type="file" name="photo" :value="old('photo')"
                    required autofocus autocomplete="photo" />
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div> --}}

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
