@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full px-4 py-2 text-sm leading-5 text-white bg-[#2A977A] hover:bg-[#1b6b56] focus:outline-none focus:bg-[#1b6b56] transition duration-150 ease-in-out' : 'block w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
