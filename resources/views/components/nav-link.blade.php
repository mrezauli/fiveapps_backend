@props(['active'])

@php
    // $classes = ($active ?? false)
    //             ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
    //             : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
    $classes = $active ?? false ? 'flex justify-start items-center p-2 px-3 bg-green-600 rounded hover:bg-green-700 text-white text-sm w-full' : 'flex justify-start items-center p-2 px-3 bg-slate-100 rounded hover:bg-slate-200 text-sm w-full';
@endphp

<a id="{{ $active ? 'activeLink' : '' }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
