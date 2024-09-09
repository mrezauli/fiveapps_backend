<x-app-layout>
    @section('title', 'Edit result')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <form action="{{ route('itee.results.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $result->id }}">
                        <div>
                            <x-input-label for="passer_id" :value="__('PasserID')" />
                            <x-text-input id="passer_id" name="passer_id" type="text" class="mt-1 block w-full" :value="old('passer_id', $result->passer_id)" required autocomplete="passer_id" />
                            <x-input-error class="mt-2" :messages="$errors->get('passer_id')" />
                        </div>
                        <div>
                            <x-input-label for="examine_id" :value="__('Examinee No.')" />
                            <x-text-input id="examine_id" name="examine_id" type="text" class="mt-1 block w-full" :value="old('examine_id', $result->examine_id)" required autocomplete="examine_id" />
                            <x-input-error class="mt-2" :messages="$errors->get('examine_id')" />
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $result->name)" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="dob" :value="__('Birth Date')" />
                            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $result->dob)" max="{{ date('Y-m-d') }}" required autocomplete="dob" />
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div>
                            <x-input-label for="exam_type" :value="__('Exam Type')" />
                            <x-select id="exam_type" name="exam_type" class="mt-1 block w-full" required>
                                <option value="">Select Exam Type</option>
                                <option value="fe" @selected(old_with('exam_type', 'fe', $result->exam_type))>FE</option>
                                <option value="ip" @selected(old_with('exam_type', 'ip', $result->exam_type))>IP</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('exam_type')" />
                        </div>
                        <div id="fe_ex_sec" class="grid grid-cols-2 justify-center items-center gap-1" style="{{ $result->exam_type !== 'fe' ? 'display: none' : '' }}">
                            <div class="rounded p-2 hover:bg-slate-200 active:bg-slate-300 relative">
                                <x-input-label for="morning_passer" class="absolute top-0 left-0 w-full h-full cursor-pointer" />
                                <span class="block font-medium text-sm text-gray-700">{{ __('Morning Passer') }}</span>
                                <x-text-input id="morning_passer" name="morning_passer" type="checkbox" class="mt-1 w-5 h-5" :checked="old('morning_passer', $result->morning_passer)" autocomplete="morning_passer" />
                                <x-input-error class="mt-2" :messages="$errors->get('morning_passer')" />
                            </div>
                            <div class="rounded p-2 hover:bg-slate-200 active:bg-slate-300 relative">
                                <x-input-label for="afternoon_passer" class="absolute top-0 left-0 w-full h-full cursor-pointer" />
                                <span class="block font-medium text-sm text-gray-700">{{ __('Afternoon Passer') }}</span>
                                <x-text-input id="afternoon_passer" name="afternoon_passer" type="checkbox" class="mt-1 w-5 h-5" :checked="old('afternoon_passer', $result->afternoon_passer)" autocomplete="afternoon_passer" />
                                <x-input-error class="mt-2" :messages="$errors->get('afternoon_passer')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="passing_session" :value="__('Passing Session')" />
                            <x-text-input id="passing_session" name="passing_session" type="month" class="mt-1 block w-full" :value="old('passing_session', $result->passing_session)" max="{{ date('Y-m') }}" required autocomplete="passing_session" />
                            <x-input-error class="mt-2" :messages="$errors->get('passing_session')" />
                        </div>
                        <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
