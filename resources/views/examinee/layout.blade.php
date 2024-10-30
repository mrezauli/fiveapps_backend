<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('examinee.favicon') <!-- Including the sidebar -->

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/style.css') }}">
    <!-- end inject -->
</head>

<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <!--======================================
        START HEADER AREA
    ======================================-->
    <header class="header-menu-area">
        <div class="bg-white shadow-sm header-menu-content dashboard-menu-content pr-30px pl-30px">
            <div class="container-fluid">
                <div class="main-menu-content">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="logo-box logo--box">
                                <a href="{{ url('/') }}" class="logo"><img
                                        src="{{ asset('aduca/images/logoBDITEC.png') }}" alt="logo"></a>
                                <div class="user-btn-action">
                                    <div class="shadow-sm off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm"
                                        data-toggle="tooltip" data-placement="top" title="Main menu">
                                        <i class="la la-bars"></i>
                                    </div>
                                </div>
                            </div><!-- end logo-box -->
                            <div class="menu-wrapper">
                                <div class="nav-right-button d-flex align-items-center">
                                    <div class="user-action-wrap d-flex align-items-center">
                                        <div class="shop-cart user-profile-cart">
                                            <ul>
                                                <li>
                                                    <div class="shop-cart-btn">
                                                        <div class="avatar-xs">
                                                            <img class="rounded-full img-fluid"
                                                                src="{{ asset('assets/images/profile.png') }}"
                                                                alt="Avatar image">
                                                        </div>
                                                        <span class="dot-status bg-1"></span>
                                                    </div>
                                                    <ul
                                                        class="p-0 cart-dropdown-menu after-none notification-dropdown-menu">
                                                        <li class="menu-heading-block d-flex align-items-center">
                                                            <a href="{{ route('examinee.profile') }}"
                                                                class="flex-shrink-0 avatar-sm d-block">
                                                                <img class="rounded-full img-fluid"
                                                                    src="{{ asset('assets/images/profile.png') }}"
                                                                    alt="Avatar image">
                                                            </a>
                                                            <div class="ml-2">
                                                                <h4><a href="{{ route('examinee.profile') }}"
                                                                        class="text-black">{{ auth()->user()->name }}</a>
                                                                </h4>
                                                                <span
                                                                    class="d-block fs-14 lh-20">{{ auth()->user()->email }}</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div
                                                                class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                                <button
                                                                    class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                                    title="Dark mode">
                                                                    <svg class="mr-1" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path
                                                                            d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z">
                                                                        </path>
                                                                    </svg>
                                                                    Dark Mode
                                                                </button>
                                                                <button
                                                                    class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                                    title="Light mode">
                                                                    <svg class="mr-1" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <circle cx="12" cy="12" r="5">
                                                                        </circle>
                                                                        <line x1="12" y1="1"
                                                                            x2="12" y2="3"></line>
                                                                        <line x1="12" y1="21"
                                                                            x2="12" y2="23"></line>
                                                                        <line x1="4.22" y1="4.22"
                                                                            x2="5.64" y2="5.64"></line>
                                                                        <line x1="18.36" y1="18.36"
                                                                            x2="19.78" y2="19.78"></line>
                                                                        <line x1="1" y1="12"
                                                                            x2="3" y2="12"></line>
                                                                        <line x1="21" y1="12"
                                                                            x2="23" y2="12"></line>
                                                                        <line x1="4.22" y1="19.78"
                                                                            x2="5.64" y2="18.36"></line>
                                                                        <line x1="18.36" y1="5.64"
                                                                            x2="19.78" y2="4.22"></line>
                                                                    </svg>
                                                                    Light Mode
                                                                </button>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <ul class="generic-list-item">
                                                                <li>
                                                                    <form method="POST" style="display: inline;"
                                                                        action="{{ route('logout') }}">
                                                                        @csrf
                                                                        <a href="{{ route('logout') }}"
                                                                            id="logout-link">
                                                                            <i class="mr-1 la la-power-off"></i> Logout
                                                                        </a>
                                                                    </form>

                                                                </li>
                                                                <li>
                                                                    <div class="section-block"></div>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div><!-- end shop-cart -->
                                    </div>
                                </div><!-- end nav-right-button -->
                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
        <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
            <div class="shadow-sm off-canvas-menu-close main-menu-close icon-element icon-element-sm"
                data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <h4 class="off-canvas-menu-heading pt-20px">Profile</h4>
            <ul class="pt-1 pb-2 generic-list-item off-canvas-menu-list border-bottom border-bottom-gray">
                <li><a href="{{ route('examinee.profile') }}">My profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                            previewlistener="true">
                            Logout</a>
                    </form>
                </li>
            </ul>
            <div class="px-3 mt-4 theme-picker d-flex align-items-center justify-content-center">
                <button
                    class="theme-picker-btn dark-mode-btn btn theme-btn-sm theme-btn-white w-100 font-weight-semi-bold justify-content-center"
                    title="Dark mode">
                    <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    Dark Mode
                </button>
                <button
                    class="theme-picker-btn light-mode-btn btn theme-btn-sm theme-btn-white w-100 font-weight-semi-bold justify-content-center"
                    title="Light mode">
                    <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                    Light Mode
                </button>
            </div>
        </div><!-- end off-canvas-menu -->
    </header><!-- end header-menu-area -->
    <!--======================================
        END HEADER AREA
======================================-->

    <!-- ================================
    START DASHBOARD AREA
================================= -->
    <section class="dashboard-area">
        <div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">
            <div class="shadow-sm off-canvas-menu-close dashboard-menu-close icon-element icon-element-sm"
                data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <div class="px-4 logo-box">
                <a href="{{ url('/') }}" class="logo"><img src="{{ asset('aduca/images/logoBDITEC.png') }}"
                        alt="logo"></a>
            </div>
            <ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
                <li class="{{ Route::is('dashboard') ? 'page-active' : '' }}"><a
                        href="{{ route('dashboard') }}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                        </svg> Dashboard</a></li>
                <li class="{{ Route::is('examinee.profile') ? 'page-active' : '' }}"><a
                        href="{{ route('examinee.profile') }}"><svg class="mr-2"
                            xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                        </svg> My Profile</a></li>
                <li class="{{ Route::is('examinee.index') ? 'page-active' : '' }}"><a
                        href="{{ route('examinee.index') }}"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                        </svg> All Exams</a></li>
                <li class="{{ Route::is('examinee.enrolled') ? 'page-active' : '' }}"><a
                        href="{{ route('examinee.enrolled') }}"><svg class="mr-2"
                            xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                        </svg> Enrolled Courses</a></li>
                <li class="{{ Route::is('examinee.settings') ? 'page-active' : '' }}"><a
                        href="{{ route('examinee.settings') }}"><svg class="mr-2"
                            xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                        </svg> Settings</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            previewlistener="true">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px"
                                viewBox="0 0 24 24" width="18px">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path
                                    d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z" />
                            </svg> Logout</a>
                    </form>
                </li>
            </ul>
        </div><!-- end off-canvas-menu -->
        <div class="dashboard-content-wrap">
            <div class="mb-4 ml-3 dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent">
                <i class="mr-1 la la-bars"></i> Dashboard Nav
            </div>
            <div class="container-fluid" style="display: flex;flex-direction: column;min-height: 100vh;">
                <div style="flex: 1;">
                    <div class="mb-5 section-block">
                        @if (isset($message))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    @yield('content') <!-- Dynamic content will be injected here -->
                </div>

                <div class="pb-4 row align-items-center dashboard-copyright-content">
                    <div class="col-lg-6">
                        <p class="copy-desc">&copy; 2024 BCC. All Rights Reserved by <a
                                href="https://bcc.gov.bd/">Bangladesh Computer Council</a></p>
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->

        </div><!-- end dashboard-content-wrap -->
    </section><!-- end dashboard-area -->
    <!-- ================================
    END DASHBOARD AREA
================================= -->

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <!-- template js files -->
    <script src="{{ asset('aduca/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('aduca/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('aduca/js/isotope.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('aduca/js/fancybox.js') }}"></script>
    <script src="{{ asset('aduca/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('aduca/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('aduca/js/animated-skills.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery.MultiFile.min.js') }}"></script>
    <script src="{{ asset('aduca/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutLink = document.getElementById('logout-link');
            const logoutForm = logoutLink.closest('form');

            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                logoutForm.submit();
            });
        });
    </script>
</body>

</html>
