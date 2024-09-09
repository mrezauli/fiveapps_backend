<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-[100dvh] flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-green-100 to-red-100">
        <div class="flex flex-col justify-center items-center grow w-full relative px-2">
            <div>
                <a href="/">
                    <img src="{{ asset('assets/images/bcc_logo.png') }}" alt="" class="block h-14 w-auto fill-current text-gray-80">
                    {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
            <div class="absolute bottom-0 w-full select-none">
                <img src="{{ asset('assets/images/footer_bottom_bg.png') }}" alt="" class="absolute bottom-0 left-1/2 -translate-x-1/2 pointer-events-none">
                <div class="bg-[#737272] absolute bottom-0 w-full h-[8px] sm:h-[14px]"></div>
            </div>
        </div>
        {{-- footer --}}
        <div class="w-full mx-5 bg-gradient-to-br from-green-100 to-red-100 flex justify-center items-center">
            <div class="w-full sm:max-w-5xl grid grid-cols-1 text-center sm:grid-cols-[auto_1fr_auto] justify-center items-center text-xs sm:text-sm py-2 px-2">
                <div>&copy; {{ date('Y') }}, Bangladesh Computer Council (BCC), Dhaka</div>
                <div class="flex justify-center items-center">
                    <button id="download_page_open" class="underline hover:no-underline cursor-pointer"><i class="fa-solid fa-download"></i> Download Our Apps</button>
                </div>
                <div>Developed by, <a href="https://touchandsolve.com" target="_blank" class="underline">Touch and Solve</a></div>
            </div>
        </div>
        <x-appsdownloadmodal></x-appsdownloadmodal>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    @yield('scripts')
</body>

</html>
