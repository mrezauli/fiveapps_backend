<x-app-layout>
    @section('title', 'Export Applicants Data')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Export Applicants Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="{{-- max-w-7xl --}} mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-xl">
                    <h2 class="text-xl font-semibold">Export Options</h2>
                </div>
                <form method="post" action="{{ url()->current() }}" class="pt-0 p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <div class="space-y-2">
                            <div class="font-medium text-sm text-gray-700">Application registered between dates -</div>
                            <div class="flex justify-center items-center gap-2 select-none relative">
                                <input type="date" name="from_date" id="from_date" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))) }}" max="{{ date('Y-m-d') }}">
                                <span>-</span>
                                <input type="date" name="to_date" id="to_date" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d')))) }}" min="{{ date('Y-m-d') }}">
                                <div class="absolute py-1 text-slate-800 select-none w-full top-full grid grid-cols-2 justify-center items-center text-center text-xs">
                                    <label for="from_date">From Date</label>
                                    <label for="to_date">To Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <x-input-label for="payment_status" :value="__('Payment Status -')" />
                            <x-select id="payment_status" name="payment_status" class="mt-1 block w-full" required>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Paid" selected>Paid</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('payment_status')" />
                        </div>
                        <div class="space-y-2">
                            <x-input-label for="status" :value="__('Status -')" />
                            <x-select id="status" name="status" class="mt-1 block w-full" required>
                                <option value="0">Pending</option>
                                <option value="1" selected>Accepted</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col md:flex-row justify-center items-center md:items-end gap-5">
                        <div class="space-y-2 w-full md:w-80">
                            <x-input-label for="export_format" :value="__('Select export format')" />
                            <x-select id="export_format" name="export_format" class="mt-1 block w-full" required>
                                <option value="xlsx"selected>Excel</option>
                                <option value="csv">CSV</option>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('export_format')" />
                        </div>
                        <x-primary-button class="px-10 py-3 w-full md:w-auto text-center">Download</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
