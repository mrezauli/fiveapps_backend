<x-guest-layout>
    <x-auth-card>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, you need to verify your mobile phone number.') }}
        </div>

        <div class="text-sm text-gray-600">
            {{ __('Please enter the OTP sent to your number:') }} {{ auth()->user()->phone }}
        </div>

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.verify-mobile') }}">
                @csrf

                <div>
                    <x-label for="code" :value="__('Code')" />

                    <x-input id="code" class="block w-full mt-1" type="number" max="999999" min="111111" name="code" :value="old('code')"
                        required autofocus />
                </div>

                <div class="mt-4">
                    <x-button>
                        {{ __('Verify') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
