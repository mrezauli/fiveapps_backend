<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/fontawesome.min.css">
    @if ($__env->yieldContent('initDataTable'))
        <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.2/fh-4.0.1/r-3.0.2/sc-2.4.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/datatables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @yield('styles')
</head>

<body class="font-sans antialiased flex relative">
    <div id="navdrawer" class="fixed lg:relative z-10 h-[100dvh] overflow-y-auto transition-[left] duration-500 -left-full lg:left-0">
        @include('layouts.sidebar')
        <div id="navdrawer-overlay" class="fixed hidden lg:hidden top-0 left-0 w-full h-full bg-black bg-opacity-50 -z-[1]"></div>
    </div>
    <div class="max-h-[100dvh] overflow-y-auto bg-gray-100 grow">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-gray-50">
                <div class="{{-- max-w-7xl --}} mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="px-3 md:px-0">
            {{ $slot }}
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/js/all.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const eElement = document.querySelector('[data-active="true"]');
        const element = document.getElementById("activeLink");
        if(eElement) {
            eElement.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
            // setTimeout(() => {
            //     element.scrollIntoView({
            //         behavior: "smooth",
            //         block: "center"
            //     });
            // }, 1000);
        } else {
            element.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        }
    </script>
    @if ($__env->yieldContent('initDataTable'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.2/fh-4.0.1/r-3.0.2/sc-2.4.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/datatables.min.js"></script> @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')
</body>

</html>
