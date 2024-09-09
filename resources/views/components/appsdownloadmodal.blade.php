<div id="download_page_container" class="w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center fixed top-0 left-0 z-[999] select-none" style="{{ request('show') != 'apps' ? 'display: none;' : '' }}">

    <div id="download_modal" class="bg-white md:rounded-md shadow-lg p-4 sm:p-5 md:p-7 md:m-3 w-full md:max-w-4xl h-dvh md:h-auto md:max-h-[60dvh] {{ request('show') != 'apps' ? 'scale-90' : '' }} transition-[transform,height] duration-300 z-50 overflow-hidden">

        <div class="flex items-center justify-between mb-5">
            <div id="download_page_title" class="text-lg font-semibold text-gray-700" style="{{ request('app') != null ? 'display: none;' : '' }}">Download Apps</div>
            <button id="download_page_back" class="font-semibold text-gray-700 flex justify-center items-center gap-1 px-2 transition-colors hover:bg-slate-100 focus:bg-slate-200 rounded-md border border-transparent focus:border-slate-300" style="{{ request('app') == null ? 'display: none;' : '' }}"><i class="fa-solid fa-angle-left"></i><span>Back</span></button>
            <div class="cursor-pointer" id="download_page_close">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        {{-- Apps List : Main Screen --}}
        <div id="all_apps" class="relative w-full h-full p-1 overflow-y-auto z-10" style="{{ request('app') != null ? 'display: none; right: 200px' : '' }}">
            <div class="flex flex-col justify-center items-center gap-2">
                <div data-appname="bcc" class="openapp flex justify-between items-center w-full gap-3 bg-green-100 text-green-800 hover:shadow-md py-2 px-4 rounded-md cursor-pointer group">
                    <div class="flex justify-center items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-b rounded-full shadow-md from-green-50 to-green-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/bcc_logo.png') }}" alt="BCC Connect" class="w-8">
                        </div>
                        <p class="text-center font-bold text-sm">BCC Connect</p>
                    </div>
                    <i class="fa-solid fa-angle-right transition-transform group-active:-translate-x-2"></i>
                </div>
                <div data-appname="ndc" class="openapp flex justify-between items-center w-full gap-3 bg-cyan-100 text-cyan-900 hover:shadow-md py-2 px-4 rounded-md cursor-pointer group">
                    <div class="flex justify-center items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-b rounded-full shadow-md from-cyan-50 to-cyan-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/ndc_logo.png') }}" alt="NDC" class="w-8">
                        </div>
                        <p class="text-center font-bold text-sm">NDC</p>
                    </div>
                    <i class="fa-solid fa-angle-right transition-transform group-active:-translate-x-2"></i>
                </div>
                <div data-appname="itee" class="openapp flex justify-between items-center w-full gap-3 bg-sky-100 text-sky-700 hover:shadow-md py-2 px-4 rounded-md cursor-pointer group">
                    <div class="flex justify-center items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-b rounded-full shadow-md from-sky-50 to-sky-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/itec_logo.png') }}" alt="ITEE" class="w-8">
                        </div>
                        <p class="text-center font-bold text-sm">ITEE</p>
                    </div>
                    <i class="fa-solid fa-angle-right transition-transform group-active:-translate-x-2"></i>
                </div>
                <div data-appname="bkiict" class="openapp flex justify-between items-center w-full gap-3 bg-lime-100 text-lime-700 hover:shadow-md py-2 px-4 rounded-md cursor-pointer group">
                    <div class="flex justify-center items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-b rounded-full shadow-md from-lime-50 to-lime-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/bkiict-logo.svg') }}" alt="BKIICT" class="w-8">
                        </div>
                        <p class="text-center font-bold text-sm">BKIICT</p>
                    </div>
                    <i class="fa-solid fa-angle-right transition-transform group-active:-translate-x-2"></i>
                </div>
                <div data-appname="vlm" class="openapp flex justify-between items-center w-full gap-3 bg-red-100 text-red-900 hover:shadow-md py-2 px-4 rounded-md cursor-pointer group">
                    <div class="flex justify-center items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-b rounded-full shadow-md from-red-50 to-red-300 flex justify-center items-center">
                            <img src="{{ asset('assets/images/vehicle.svg') }}" alt="Vehicle Log Management" class="w-8">
                        </div>
                        <p class="text-center font-bold text-sm">Vehicle Log Management</p>
                    </div>
                    <i class="fa-solid fa-angle-right transition-transform group-active:-translate-x-2"></i>
                </div>
            </div>
        </div>
        {{-- /Apps List : Main Screen --}}

        {{-- App: BCC Connect --}}
        <div data-appname="bcc" class="data_list_apps relative w-full h-full p-1 overflow-y-auto z-20" style="{{ request('app') != 'bcc' ? 'display: none; right: -200px' : '' }}">
            <div class="flex flex-col justify-center items-center gap-2">
                <div class="text-2xl font-bold">BCC Connect Apps list</div>
                <div class="flex flex-col justify-center items-center gap-2 w-full mt-3 overflow-y-auto">

                    @php
                        $bcc_apps = getApps('bcc');
                    @endphp
                    @if (count($bcc_apps) == 0)
                        <div class="text-center text-red-500 font-semibold">No apps found</div>
                    @else
                        @foreach ($bcc_apps as $bcc_app)
                            @if ($bcc_app->getExtension() == 'apk' || $bcc_app->getExtension() == 'ipa')
                                <div class="grid grid-cols-[auto_1fr_auto] justify-center items-center gap-2 w-full p-2 px-3 rounded-md bg-slate-100 text-xs sm:text-sm md:text-base">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-50 to-white rounded-lg flex justify-center items-center shadow-md">
                                        @if ($bcc_app->getExtension() == 'apk')
                                            <img src="{{ asset('assets/images/android_icon.png') }}" alt="Icon Android" class="w-8 pointer-events-none">
                                        @elseif ($bcc_app->getExtension() == 'ipa')
                                            <img src="{{ asset('assets/images/apple_icon.png') }}" alt="Icon Apple" class="w-8 pointer-events-none">
                                        @endif
                                    </div>
                                    <div class="font-bold truncate" title="{{ $bcc_app->getFileName() }}">
                                        {{ $bcc_app->getFileName() }}
                                    </div>
                                    <a href="{{ appGetAsset('bcc', $bcc_app->getFileName()) }}" download="{{ $bcc_app->getFileName() }}" class="transition-colors bg-blue-50 hover:bg-blue-100 focus:bg-blue-100 border border-transparent focus:border-blue-300 text-blue-700 font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-download text-blue-500"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        {{-- /App: BCC Connect --}}
        {{-- App: NDC --}}
        <div data-appname="ndc" class="data_list_apps relative w-full h-full p-1 overflow-y-auto z-20" style="{{ request('app') != 'ndc' ? 'display: none; right: -200px' : '' }}">
            <div class="flex flex-col justify-center items-center gap-2">
                <div class="text-2xl font-bold">NDC Apps list</div>
                <div class="flex flex-col justify-center items-center gap-2 w-full mt-3 overflow-y-auto">

                    @php
                        $ndc_apps = getApps('ndc');
                    @endphp
                    @if (count($ndc_apps) == 0)
                        <div class="text-center text-red-500 font-semibold">No apps found</div>
                    @else
                        @foreach ($ndc_apps as $ndc_app)
                            @if ($ndc_app->getExtension() == 'apk' || $ndc_app->getExtension() == 'ipa')
                                <div class="grid grid-cols-[auto_1fr_auto] justify-center items-center gap-2 w-full p-2 px-3 rounded-md bg-slate-100 text-xs sm:text-sm md:text-base">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-50 to-white rounded-lg flex justify-center items-center shadow-md">
                                        @if ($ndc_app->getExtension() == 'apk')
                                            <img src="{{ asset('assets/images/android_icon.png') }}" alt="Icon Android" class="w-8 pointer-events-none">
                                        @elseif ($ndc_app->getExtension() == 'ipa')
                                            <img src="{{ asset('assets/images/apple_icon.png') }}" alt="Icon Apple" class="w-8 pointer-events-none">
                                        @endif
                                    </div>
                                    <div class="font-bold truncate" title="{{ $ndc_app->getFileName() }}">
                                        {{ $ndc_app->getFileName() }}
                                    </div>
                                    <a href="{{ appGetAsset('ndc', $ndc_app->getFileName()) }}" download="{{ $ndc_app->getFileName() }}" class="transition-colors bg-blue-50 hover:bg-blue-100 focus:bg-blue-100 border border-transparent focus:border-blue-300 text-blue-700 font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-download text-blue-500"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        {{-- /App: NDC --}}
        {{-- App: ITEE --}}
        <div data-appname="itee" class="data_list_apps relative w-full h-full p-1 overflow-y-auto z-20" style="{{ request('app') != 'itee' ? 'display: none; right: -200px' : '' }}">
            <div class="flex flex-col justify-center items-center gap-2">
                <div class="text-2xl font-bold">ITEE Apps list</div>
                <div class="flex flex-col justify-center items-center gap-2 w-full mt-3 overflow-y-auto">

                    @php
                        $itee_apps = getApps('itee');
                    @endphp
                    @if (count($itee_apps) == 0)
                        <div class="text-center text-red-500 font-semibold">No apps found</div>
                    @else
                        @foreach ($itee_apps as $itee_app)
                            @if ($itee_app->getExtension() == 'apk' || $itee_app->getExtension() == 'ipa')
                                <div class="grid grid-cols-[auto_1fr_auto] justify-center items-center gap-2 w-full p-2 px-3 rounded-md bg-slate-100 text-xs sm:text-sm md:text-base">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-50 to-white rounded-lg flex justify-center items-center shadow-md">
                                        @if ($itee_app->getExtension() == 'apk')
                                            <img src="{{ asset('assets/images/android_icon.png') }}" alt="Icon Android" class="w-8 pointer-events-none">
                                        @elseif ($itee_app->getExtension() == 'ipa')
                                            <img src="{{ asset('assets/images/apple_icon.png') }}" alt="Icon Apple" class="w-8 pointer-events-none">
                                        @endif
                                    </div>
                                    <div class="font-bold truncate" title="{{ $itee_app->getFileName() }}">
                                        {{ $itee_app->getFileName() }}
                                    </div>
                                    <a href="{{ appGetAsset('itee', $itee_app->getFileName()) }}" download="{{ $itee_app->getFileName() }}" class="transition-colors bg-blue-50 hover:bg-blue-100 focus:bg-blue-100 border border-transparent focus:border-blue-300 text-blue-700 font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-download text-blue-500"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        {{-- /App: ITEE --}}
        {{-- App: BKIICT --}}
        <div data-appname="bkiict" class="data_list_apps relative w-full h-full p-1 overflow-y-auto z-20" style="{{ request('app') != 'bkiict' ? 'display: none; right: -200px' : '' }}">
            <div class="flex flex-col justify-center items-center gap-2">
                <div class="text-2xl font-bold">BKIICT Apps list</div>
                <div class="flex flex-col justify-center items-center gap-2 w-full mt-3 overflow-y-auto">

                    @php
                        $bkiict_apps = getApps('bkiict');
                    @endphp
                    @if (count($bkiict_apps) == 0)
                        <div class="text-center text-red-500 font-semibold">No apps found</div>
                    @else
                        @foreach ($bkiict_apps as $bkiict_app)
                            @if ($bkiict_app->getExtension() == 'apk' || $bkiict_app->getExtension() == 'ipa')
                                <div class="grid grid-cols-[auto_1fr_auto] justify-center items-center gap-2 w-full p-2 px-3 rounded-md bg-slate-100 text-xs sm:text-sm md:text-base">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-50 to-white rounded-lg flex justify-center items-center shadow-md">
                                        @if ($bkiict_app->getExtension() == 'apk')
                                            <img src="{{ asset('assets/images/android_icon.png') }}" alt="Icon Android" class="w-8 pointer-events-none">
                                        @elseif ($bkiict_app->getExtension() == 'ipa')
                                            <img src="{{ asset('assets/images/apple_icon.png') }}" alt="Icon Apple" class="w-8 pointer-events-none">
                                        @endif
                                    </div>
                                    <div class="font-bold truncate" title="{{ $bkiict_app->getFileName() }}">
                                        {{ $bkiict_app->getFileName() }}
                                    </div>
                                    <a href="{{ appGetAsset('bkiict', $bkiict_app->getFileName()) }}" download="{{ $bkiict_app->getFileName() }}" class="transition-colors bg-blue-50 hover:bg-blue-100 focus:bg-blue-100 border border-transparent focus:border-blue-300 text-blue-700 font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-download text-blue-500"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        {{-- /App: BKIICT --}}
        {{-- App: Vehicle Log Management --}}
        <div data-appname="vlm" class="data_list_apps relative w-full h-full p-1 overflow-y-auto z-20" style="{{ request('app') != 'vlm' ? 'display: none; right: -200px' : '' }}">
            <div class="flex flex-col justify-center items-center gap-2">
                <div class="text-2xl font-bold">Vehicle Log Management Apps list</div>
                <div class="flex flex-col justify-center items-center gap-2 w-full mt-3 overflow-y-auto">

                    @php
                        $vlm_apps = getApps('vlm');
                    @endphp
                    @if (count($vlm_apps) == 0)
                        <div class="text-center text-red-500 font-semibold">No apps found</div>
                    @else
                        @foreach ($vlm_apps as $vlm_app)
                            @if ($vlm_app->getExtension() == 'apk' || $vlm_app->getExtension() == 'ipa')
                                <div class="grid grid-cols-[auto_1fr_auto] justify-center items-center gap-2 w-full p-2 px-3 rounded-md bg-slate-100 text-xs sm:text-sm md:text-base">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-50 to-white rounded-lg flex justify-center items-center shadow-md">
                                        @if ($vlm_app->getExtension() == 'apk')
                                            <img src="{{ asset('assets/images/android_icon.png') }}" alt="Icon Android" class="w-8 pointer-events-none">
                                        @elseif ($vlm_app->getExtension() == 'ipa')
                                            <img src="{{ asset('assets/images/apple_icon.png') }}" alt="Icon Apple" class="w-8 pointer-events-none">
                                        @endif
                                    </div>
                                    <div class="font-bold truncate" title="{{ $vlm_app->getFileName() }}">
                                        {{ $vlm_app->getFileName() }}
                                    </div>
                                    <a href="{{ appGetAsset('vlm', $vlm_app->getFileName()) }}" download="{{ $vlm_app->getFileName() }}" class="transition-colors bg-blue-50 hover:bg-blue-100 focus:bg-blue-100 border border-transparent focus:border-blue-300 text-blue-700 font-bold py-2 px-4 rounded">
                                        <i class="fa-solid fa-download text-blue-500"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
        {{-- /App: Vehicle Log Management --}}
    </div>
    <div id="backdrop" class="absolute top-0 left-0 w-full h-full cursor-pointer z-10"></div>
</div>

@section('scripts')
    <script>
        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                if ($('#all_apps').css('display') == 'none') {
                    showAllApps();
                } else {
                    closeDownloadPage();
                }
            }
        });
        $('#download_page_open').click(function() {
            openDownloadPage();
        });

        $('#backdrop, #download_page_close').click(function() {
            closeDownloadPage();
        });

        $('.openapp').click(function(e) {
            var appName = $(e.target).closest('.openapp').data('appname');
            showSpecificApp(appName);
        })

        $('#download_page_back').click(function() {
            showAllApps();
        });

        function showAllApps() {
            $('#download_page_back').fadeOut('fast', () => {
                $('#download_page_title').fadeIn('fast');
            });
            history.pushState({}, null, '?show=apps');

            $('.data_list_apps').animate({
                opacity: 'hide',
                right: '-200px',
            }, 'fast', 'linear', function() {
                $('#all_apps').animate({
                    opacity: 'show',
                    right: '0',
                }, 'fast', 'linear');
            });
        }

        function showSpecificApp(appName) {
            history.pushState({}, null, '?show=apps&app=' + appName);

            $('#download_page_title').fadeOut('fast', () => {
                $('#download_page_back').fadeIn('fast');
            });

            $('#all_apps').animate({
                opacity: 'hide',
                right: '200px',
            }, 'fast', 'linear', function() {
                $('.data_list_apps[data-appname="' + appName + '"]').animate({
                    opacity: 'show',
                    right: '0',
                }, 'fast', 'linear');
            });
        }

        function openDownloadPage() {
            showAllApps();
            $('#download_page_container').fadeIn('fast');
            $('#download_modal').css('transform', 'scaleX(1) scaleY(1)');
        }

        function closeDownloadPage() {
            // showAllApps();
            history.pushState({}, null, '{{ url()->current() }}');
            $('#download_page_container').fadeOut('fast');
            $('#download_modal').css('transform', 'scaleX(0.9) scaleY(0.9)');
        }
    </script>
@endsection
