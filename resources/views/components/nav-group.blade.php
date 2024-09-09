@props(['title' => 'Module group'])
@use('\App\Helper\CustomHelper', 'Helper')


{{-- @if (Helper::canView('', 'Super Admin')) --}}
@if (strlen($slot) > 0)
    <div class="flex flex-col justify-center items-start gap-1">
        <span class="font-bold block p-1 px-2 ">{{ $title }}</span>
        <hr class="w-full bg-slate-300 h-[2px] rounded-xl mb-2">
        <div class="flex flex-col justify-center items-center pl-2 w-full gap-2">{{ $slot }}</div>
    </div>
    {{-- @else
    <div class="flex flex-col justify-center items-center w-full gap-2">{{ $slot }}</div> --}}
@endif
