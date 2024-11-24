<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    @include('examinee.favicon') <!-- Including the sidebar -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/animated-headline.css') }}">
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
        <div class="bg-white header-menu-content">
            <div class="container">
                <div class="main-menu-content">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="logo-box">
                                <a href="{{ url('/') }}" class="logo"><img
                                        src="{{ asset('aduca/images/logoBDITEC.png') }}" alt="logo"></a>
                                <div class="user-btn-action">
                                    <div class="shadow-sm off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm"
                                        data-toggle="tooltip" data-placement="top" title="Main menu">
                                        <i class="la la-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                        <div class="col-lg-10">
                            <div class="menu-wrapper">
                                <nav class="main-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ url('/') }}">Home</a>
                                        </li>
                                    </ul><!-- end ul -->
                                </nav><!-- end main-menu -->
                                <div class="pl-4 mr-3 nav-right-button border-left border-left-gray">
                                    <ul class="generic-list-item">
                                        @if (Route::has('login'))
                                            @auth
                                                <li><a href="{{ route('dashboard') }}"
                                                        class="text-white btn theme-btn theme-btn-sm">Dashboard</a></li>
                                            @else
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                                @if (Route::has('register'))
                                                    <li>Or</li>
                                                    <li><a href="{{ route('register') }}"
                                                            class="text-white btn theme-btn theme-btn-sm"><i
                                                                class="mr-1 la la-user-plus"></i> Register</a></li>
                                                @endif
                                            @endauth
                                        @endif
                                    </ul>
                                </div><!-- end nav-right-button -->
                                <div class="theme-picker d-flex align-items-center">
                                    <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                        <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                        </svg>
                                    </button>
                                    <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                        <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="5"></circle>
                                            <line x1="12" y1="1" x2="12" y2="3">
                                            </line>
                                            <line x1="12" y1="21" x2="12" y2="23">
                                            </line>
                                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64">
                                            </line>
                                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78">
                                            </line>
                                            <line x1="1" y1="12" x2="3" y2="12">
                                            </line>
                                            <line x1="21" y1="12" x2="23" y2="12">
                                            </line>
                                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36">
                                            </line>
                                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22">
                                            </line>
                                        </svg>
                                    </button>
                                </div>
                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container -->
        </div><!-- end header-menu-content -->
        <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
            <div class="shadow-sm off-canvas-menu-close main-menu-close icon-element icon-element-sm"
                data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <ul class="generic-list-item off-canvas-menu-list pt-90px">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
            </ul>
            <div class="px-4 pt-5 text-center btn-box">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="mr-2 btn theme-btn theme-btn-sm lh-26 theme-btn-white"><i
                                class="mr-1 la la-dashboard"></i> Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn theme-btn theme-btn-sm theme-btn-transparent"><i
                                class="mr-1 la la-sign-in"></i> Login</a>
                        @if (Route::has('register'))
                            <span class="mx-2 fs-15 font-weight-medium d-inline-block">Or</span>
                            <a href="{{ route('register') }}" class="shadow-none btn theme-btn theme-btn-sm"><i
                                    class="mr-1 la la-plus"></i>
                                Sign up</a>
                        @endif
                    @endauth
                @endif
                <div class="mt-4 theme-picker d-flex align-items-center justify-content-center">
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
            </div>
        </div><!-- end off-canvas-menu -->
        <div class="body-overlay"></div>
    </header><!-- end header-menu-area -->
    <!--======================================
        END HEADER AREA
======================================-->

    <!--================================
         START HERO AREA
=================================-->
    <section class="hero-area position-relative hero-area-3">
        <div class="hero-slider-item hero-bg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="hero-content">
                            <div class="section-heading">
                                <h2 class="pb-3 text-white section__title fs-45 lh-55">
                                    Welcome to BDITEC
                                </h2>
                                <p class="pb-4 text-white section__desc">Bangladesh IT-engineers Examination Center
                                    (BD-ITEC)</p>
                            </div><!-- end section-heading -->
                        </div><!-- end hero-content -->
                    </div><!-- end col-lg-7 -->
                    <div class="col-lg-5">
                        <div class="row hero-category-wrap">
                            <div class="col-lg-4 responsive-column-half">
                                <div class="category-item category-item-layout-2">
                                    <a href="#" class="category-content">
                                        <div class="shadow-sm icon-element icon-element-md text-color">
                                            <i class="la la-area-chart"></i>
                                        </div>
                                        <h3 class="cat__title fs-16">Pearson & VUE</h3>
                                    </a><!-- end category-content -->
                                </div><!-- end category-item -->
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 responsive-column-half">
                                <div class="category-item category-item-layout-2">
                                    <a href="#" class="category-content">
                                        <div class="shadow-sm icon-element icon-element-md text-color-2">
                                            <i class="la la-bank"></i>
                                        </div>
                                        <h3 class="cat__title fs-16">ITEE</h3>
                                    </a><!-- end category-content -->
                                </div><!-- end category-item -->
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 responsive-column-half">
                                <div class="category-item category-item-layout-2">
                                    <a href="#" class="category-content">
                                        <div class="shadow-sm icon-element icon-element-md text-color-3">
                                            <i class="la la-building"></i>
                                        </div>
                                        <h3 class="cat__title fs-16">NSDA</h3>
                                    </a><!-- end category-content -->
                                </div><!-- end category-item -->
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 responsive-column-half">
                                <div class="category-item category-item-layout-2">
                                    <a href="#" class="category-content">
                                        <div class="shadow-sm icon-element icon-element-md text-color-4">
                                            <i class="la la-bullseye"></i>
                                        </div>
                                        <h3 class="cat__title fs-16">BKIICT</h3>
                                    </a><!-- end category-content -->
                                </div><!-- end category-item -->
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 responsive-column-half">
                                <div class="category-item category-item-layout-2">
                                    <a href="#" class="category-content">
                                        <div class="shadow-sm icon-element icon-element-md text-color-5">
                                            <i class="la la-certificate"></i>
                                        </div>
                                        <h3 class="cat__title fs-16">BCC Governed</h3>
                                    </a><!-- end category-content -->
                                </div><!-- end category-item -->
                            </div><!-- end col-lg-4 -->
                            <div class="col-lg-4 responsive-column-half">
                                <div class="category-item category-item-layout-2">
                                    <a href="#" class="category-content">
                                        <div class="shadow-sm icon-element icon-element-md text-color-6">
                                            <i class="la la-chrome"></i>
                                        </div>
                                        <h3 class="cat__title fs-16">Customized</h3>
                                    </a><!-- end category-content -->
                                </div><!-- end category-item -->
                            </div><!-- end col-lg-4 -->
                        </div><!-- end row -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end hero-slider-item -->
    </section><!-- end hero-area -->
    <!--================================
        END HERO AREA
=================================-->

    <!--======================================
        START COURSE AREA
======================================-->
    <section class="overflow-hidden course-area section--padding position-relative">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="course-wrapper">
            <div class="container">
                <div class="text-center section-heading">
                    <h2 class="section__title">Explore Trending Courses</h2>
                </div><!-- end section-heading -->
                <div class="course-carousel owl-action-styled owl--action-styled mt-50px">
                    @foreach ($examFees as $examFee)
                        <div class="card card-item card-preview"
                            data-tooltip-content="#tooltip_content_{{ $examFee->exam_category->id }}">
                            <div class="card-image">
                                <a href="course-details.html" class="d-block">
                                    <?php $imageUrl = $examFee->exam_type->image; ?>
                                    <img class="card-img-top" src="{{ asset($imageUrl) }}" alt="Card image cap"
                                        style="height: 247px;">
                                </a>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">All Levels</h6>
                                <h5 class="card-title">{{ $examFee->exam_type->name }}</h5>
                                <p class="card-text">{{ $examFee->exam_category->name }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-black card-price font-weight-bold">BDT {{ $examFee->fee }} (৳)</p>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    @endforeach
                </div><!-- end tab-content -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
        END COURSE AREA
======================================-->

    <div class="section-block"></div>

    <!--======================================
        START GET STARTED AREA
======================================-->
    <section class="get-started-area section--padding position-relative">
        <div class="container">
            <div class="text-center section-heading">
                <h2 class="section__title">Why with BDITEC</h2>
            </div><!-- end section-heading -->
            <div class="row pt-60px">
                <div class="col-lg-4 responsive-column-half">
                    <div class="text-center bg-transparent shadow-none card card-item rounded-0">
                        <div class="p-0 card-body">
                            <svg width="90" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px"
                                viewBox="0 0 64 64" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path style="fill:#F0BC5E;"
                                                d="M62,55H34V42c0-1.105,0.895-2,2-2h24c1.105,0,2,0.895,2,2V55z" />
                                        </g>
                                    </g>
                                    <g>
                                        <path style="fill:#F0BC5E;"
                                            d="M22,1C13.729,1,7,7.729,7,16v8h1c0-2.209,1.791-4,4-4v-1c0-0.552,0.448-1,1-1h18    c0.552,0,1,0.448,1,1v1c2.209,0,4,1.791,4,4h1v-8C37,7.729,30.271,1,22,1z" />
                                    </g>
                                    <g>
                                        <circle cx="17" cy="22" r="1" />
                                        <circle cx="27" cy="22" r="1" />
                                        <path
                                            d="M26,28h-2c0,1.103-0.897,2-2,2s-2-0.897-2-2h-2c0,2.206,1.794,4,4,4S26,30.206,26,28z" />
                                        <path
                                            d="M60,39H36c-0.562,0-1.082,0.165-1.533,0.435L28,37.279v-2.072c2.21-1.445,3.864-3.663,4.589-6.267    C35.066,28.645,37,26.555,37,24c0-2.414-1.721-4.434-4-4.899V19c0-1.103-0.897-2-2-2H13c-1.103,0-2,0.897-2,2v0.101    C8.721,19.566,7,21.586,7,24c0,2.555,1.934,4.645,4.411,4.94c0.724,2.605,2.379,4.822,4.589,6.267v2.072L5.786,40.684    C2.924,41.638,1,44.307,1,47.325V57h32.184c0.414,1.161,1.514,2,2.816,2h6v2h-2v2h16v-2h-2v-2h6c1.654,0,3-1.346,3-3V42    C63,40.346,61.654,39,60,39z M35,24c0,1.317-0.859,2.427-2.042,2.829C32.979,26.554,33,26.28,33,26v-4.816    C34.161,21.598,35,22.698,35,24z M33,55H23v-9.586l4.182,4.182l5.421-8.674l0.549,0.183C33.062,41.389,33,41.686,33,42v6V55z     M30.652,40.271l-3.833,6.133L23.414,43l3.856-3.856L30.652,40.271z M9,24c0-1.302,0.839-2.402,2-2.816V26    c0,0.28,0.021,0.554,0.042,0.829C9.859,26.427,9,25.317,9,24z M13,26v-7h18v7c0,4.962-4.037,9-9,9S13,30.962,13,26z M22,37    c1.412,0,2.758-0.277,4-0.764v1.35l-4,4l-4-4v-1.35C19.242,36.723,20.588,37,22,37z M16.73,39.144L20.586,43l-3.404,3.404    l-3.833-6.133L16.73,39.144z M6.419,42.581l4.978-1.659l5.421,8.675L21,45.414V55H11v-7H9v3H3v-3.675    C3,45.169,4.374,43.263,6.419,42.581z M3,53h6v2H3V53z M52,61h-8v-2h8V61z M61,56c0,0.551-0.448,1-1,1H36c-0.552,0-1-0.449-1-1v-8    v-6c0-0.551,0.448-1,1-1h24c0.552,0,1,0.449,1,1V56z" />
                                        <polygon
                                            points="51.4,44.8 54.333,47 51.4,49.2 52.6,50.8 57.667,47 52.6,43.2   " />
                                        <polygon
                                            points="43.4,43.2 38.333,47 43.4,50.8 44.6,49.2 41.667,47 44.6,44.8   " />
                                        <rect x="43.538" y="46"
                                            transform="matrix(0.3881 -0.9216 0.9216 0.3881 -13.9442 72.9984)"
                                            width="8.925" height="2.001" />
                                    </g>
                                </g>
                            </svg>
                            <h5 class="pt-4 pb-2 card-title">Learn anything</h5>
                            <p class="card-text"></p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="text-center bg-transparent shadow-none card card-item rounded-0">
                        <div class="p-0 card-body">
                            <svg width="90" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path
                                            d="m432.468 68.082-28.227-21.529 17.955-23.541c5.945-7.795 17.083-9.294 24.878-3.349 7.795 5.945 9.294 17.083 3.349 24.878z"
                                            fill="#f4fbff" />
                                    </g>
                                    <g>
                                        <path
                                            d="m447.074 19.663c-2.31-1.762-4.916-2.854-7.591-3.338 2.788 5.821 2.306 12.955-1.878 18.44l-17.955 23.541 12.818 9.776 17.955-23.541c5.945-7.795 4.446-18.933-3.349-24.878z"
                                            fill="#e4f6ff" />
                                    </g>
                                    <g>
                                        <path
                                            d="m443.061 139.612-110.604-84.36c-2.196-1.675-2.618-4.812-.943-7.008l9.425-12.357c13.397-17.565 38.498-20.944 56.063-7.547l54.946 41.908c17.565 13.397 20.944 38.498 7.547 56.063l-9.425 12.357c-1.676 2.196-4.813 2.618-7.009.944z"
                                            fill="#365e7d" />
                                    </g>
                                    <g>
                                        <path
                                            d="m461.852 81.171c-1.333 4.589-3.509 9.016-6.581 13.043l-9.519 12.48c-1.669 2.188-4.796 2.609-6.984.94l-96.4-73.526c-.461.542-.911 1.097-1.347 1.669l-9.519 12.48c-1.669 2.188-1.248 5.315.94 6.984l110.632 84.38c2.188 1.669 5.315 1.248 6.984-.94l9.519-12.48c10.279-13.476 10.638-31.4 2.275-45.03z"
                                            fill="#2b4d66" />
                                    </g>
                                    <g>
                                        <path
                                            d="m82.297 68.082 28.227-21.529-17.956-23.541c-5.945-7.795-17.083-9.294-24.878-3.349-7.795 5.945-9.294 17.083-3.349 24.878z"
                                            fill="#f4fbff" />
                                    </g>
                                    <g>
                                        <path
                                            d="m81.364 32.826 17.343 22.739 11.816-9.013-17.955-23.54c-5.945-7.795-17.083-9.294-24.878-3.349-2.462 1.878-4.291 4.274-5.461 6.918 6.855-2.021 14.543.224 19.135 6.245z"
                                            fill="#e4f6ff" />
                                    </g>
                                    <g>
                                        <path
                                            d="m71.704 139.612 110.604-84.36c2.196-1.675 2.618-4.812.943-7.008l-9.425-12.357c-13.397-17.565-38.498-20.944-56.063-7.547l-54.945 41.909c-17.565 13.397-20.944 38.498-7.547 56.063l9.425 12.357c1.674 2.195 4.812 2.617 7.008.943z"
                                            fill="#365e7d" />
                                    </g>
                                    <g>
                                        <path
                                            d="m183.262 48.258-9.519-12.48c-9.538-12.506-25.029-17.79-39.482-14.923 3.533 2.373 6.749 5.346 9.473 8.918l9.519 12.48c1.669 2.188 1.248 5.315-.94 6.984l-98.462 75.098c.427.631.869 1.255 1.336 1.868l9.519 12.48c1.669 2.188 4.796 2.609 6.984.94l110.632-84.38c2.188-1.67 2.609-4.797.94-6.985z"
                                            fill="#2b4d66" />
                                    </g>
                                    <g>
                                        <path
                                            d="m196.612 430.719-61.914-34.255-27.607 80.128c-3.332 9.671.766 20.337 9.716 25.289 8.95 4.952 20.164 2.757 26.587-5.203z"
                                            fill="#365e7d" />
                                    </g>
                                    <g>
                                        <path
                                            d="m174.916 418.715-52.048 64.508c-3.921 4.859-9.628 7.556-15.515 7.805 1.729 4.485 4.987 8.381 9.454 10.852 8.95 4.952 20.164 2.757 26.587-5.203l53.218-65.958z"
                                            fill="#2b4d66" />
                                    </g>
                                    <g>
                                        <path
                                            d="m318.153 430.719 61.914-34.255 27.607 80.128c3.332 9.671-.766 20.337-9.716 25.289-8.95 4.952-20.164 2.757-26.587-5.203z"
                                            fill="#365e7d" />
                                    </g>
                                    <g>
                                        <path
                                            d="m407.673 476.591-27.607-80.128-21.274 11.77 25.612 74.337c2.501 7.259.815 15.078-3.966 20.621 5.595 2.072 11.987 1.748 17.518-1.311 8.951-4.952 13.049-15.618 9.717-25.289z"
                                            fill="#2b4d66" />
                                    </g>
                                    <g>
                                        <circle cx="257.382" cy="289.055" fill="#ffe07d" r="183.405" />
                                    </g>
                                    <g>
                                        <path
                                            d="m354.959 133.747c17.794 28.261 28.097 61.714 28.097 97.577 0 101.291-82.113 183.405-183.405 183.405-35.863 0-69.315-10.303-97.576-28.097 32.463 51.56 89.879 85.828 155.308 85.828 101.292 0 183.405-82.113 183.405-183.405-.001-65.429-34.269-122.845-85.829-155.308z"
                                            fill="#ffd064" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="m257.382 487.906c-109.647 0-198.851-89.204-198.851-198.851s89.204-198.851 198.851-198.851 198.851 89.204 198.851 198.851-89.204 198.851-198.851 198.851zm0-366.809c-92.612 0-167.958 75.346-167.958 167.958s75.346 167.958 167.958 167.958 167.958-75.346 167.958-167.958-75.345-167.958-167.958-167.958z"
                                                fill="#f4fbff" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="m390.924 141.841c32.07 35.321 51.638 82.189 51.638 133.542 0 109.647-89.204 198.851-198.851 198.851-51.353 0-98.221-19.568-133.541-51.638 36.405 40.095 88.919 65.31 147.214 65.31 109.647 0 198.851-89.204 198.851-198.851-.002-58.294-25.217-110.809-65.311-147.214z"
                                                fill="#e4f6ff" />
                                        </g>
                                    </g>
                                    <g>
                                        <circle cx="257.382" cy="289.055" fill="#365e7d" r="28.238" />
                                    </g>
                                    <g>
                                        <path
                                            d="m267.468 262.678c1.199 3.133 1.862 6.531 1.862 10.086 0 15.596-12.643 28.238-28.238 28.238-3.555 0-6.953-.663-10.086-1.862 4.061 10.613 14.335 18.153 26.376 18.153 15.596 0 28.238-12.643 28.238-28.238.001-12.041-7.539-22.316-18.152-26.377z"
                                            fill="#2b4d66" />
                                    </g>
                                    <g>
                                        <path
                                            d="m392.358 34.2 55.166 42.075c4.703 3.587 8.328 8.373 10.482 13.84 1.513 3.841 5.856 5.729 9.694 4.213 3.84-1.513 5.726-5.853 4.213-9.694-3.154-8.004-8.452-15.004-15.323-20.245l-7.527-5.741 7.304-9.575c8.434-11.059 6.299-26.919-4.76-35.353-5.357-4.086-11.988-5.842-18.663-4.942-6.677.899-12.605 4.344-16.691 9.701l-7.303 9.575-7.526-5.74c-14.744-11.244-34.028-12.469-49.637-4.803l-1.843-1.942c-9.391-9.894-22.602-15.569-36.243-15.569h-112.637c-13.642 0-26.853 5.675-36.244 15.57l-1.842 1.941c-15.61-7.667-34.894-6.441-49.637 4.803l-7.526 5.74-7.303-9.576c-8.436-11.058-24.295-13.193-35.354-4.758-5.357 4.086-8.803 10.014-9.702 16.691-.899 6.678.857 13.305 4.943 18.662l7.303 9.575-7.526 5.74c-20.754 15.829-24.76 45.592-8.931 66.345l9.518 12.479c2.017 2.647 4.945 4.348 8.243 4.792 3.26.446 6.573-.418 9.217-2.441l49.373-37.657 10.784 14.138c-51.662 37.534-85.322 98.41-85.322 167.009 0 57.635 23.764 109.816 61.996 147.287l-13.028 37.815c-4.524 13.13 1.013 27.54 13.164 34.263 4.366 2.416 9.118 3.581 13.821 3.58 8.386 0 16.613-3.705 22.201-10.63l20.596-25.527c26.599 12.521 56.281 19.537 87.575 19.537 30.853 0 60.655-6.868 87.592-19.516l20.58 25.506c5.588 6.925 13.815 10.63 22.201 10.63 4.702 0 9.456-1.165 13.821-3.58 12.151-6.723 17.688-21.132 13.164-34.263l-13.004-37.743c14.754-14.468 27.478-31.282 37.573-50.089 1.952-3.637.586-8.168-3.051-10.12-3.638-1.953-8.167-.586-10.12 3.051-33.497 62.409-98.16 101.178-168.755 101.178-105.526 0-191.377-85.851-191.377-191.377s85.85-191.377 191.375-191.377 191.377 85.851 191.377 191.377c0 20.623-3.277 40.919-9.74 60.327-1.304 3.917.814 8.149 4.731 9.453 3.917 1.303 8.149-.814 9.453-4.73 6.97-20.934 10.505-42.82 10.505-65.05 0-68.599-33.66-129.475-85.322-167.009l10.783-14.138 49.373 37.657c5.262 4.178 13.503 3.054 17.459-2.35l9.521-12.482c1.362-1.787 2.603-3.676 3.688-5.615 2.016-3.602.732-8.156-2.87-10.173-3.605-2.016-8.156-.73-10.173 2.871-.745 1.328-1.597 2.626-2.532 3.854l-8.008 10.499-106.67-81.359 8.008-10.499c10.83-14.2 31.194-16.942 45.393-6.111zm35.78-6.656c3.437-4.506 9.897-5.374 14.403-1.939 4.505 3.436 5.375 9.897 1.94 14.402l-7.304 9.576-16.341-12.463zm-27.53 451.482c2.154 6.252-.483 13.113-6.268 16.314-5.786 3.2-12.999 1.789-17.152-3.357l-18.652-23.117c11.002-6.199 21.431-13.406 31.15-21.54zm-263.031 12.957c-4.153 5.146-11.365 6.556-17.151 3.357-5.786-3.201-8.422-10.062-6.268-16.314l10.943-31.762c9.673 8.101 20.097 15.332 31.151 21.575zm-67.293-451.974c-1.665-2.182-2.38-4.883-2.014-7.603s1.77-5.135 3.952-6.8c4.503-3.435 10.965-2.567 14.403 1.939l7.303 9.576-16.34 12.463zm-1.146 92.159-8.008-10.499c-10.831-14.2-8.089-34.564 6.111-45.394l55.165-42.075c5.855-4.466 12.754-6.623 19.604-6.623 9.764 0 19.425 4.388 25.79 12.734l8.007 10.499zm253.982-79.226c.444 3.298 2.145 6.225 4.79 8.242l49.373 37.657-11.323 14.845c-29.575-18.378-64.113-29.483-101.104-30.808v-17.977h25.956c4.128 0 7.474-3.346 7.474-7.474s-3.346-7.474-7.474-7.474h-66.861c-4.128 0-7.474 3.346-7.474 7.474s3.346 7.474 7.474 7.474h25.957v17.979c-36.991 1.324-71.529 12.43-101.104 30.808l-11.323-14.845 49.372-37.657c2.647-2.017 4.348-4.945 4.792-8.243s-.423-6.571-2.441-9.217l-9.518-12.48c-1.366-1.791-2.842-3.448-4.401-4.988l.377-.397c6.582-6.935 15.84-10.912 25.401-10.912h112.637c9.561 0 18.819 3.977 25.4 10.912l.378.398c-1.558 1.54-3.034 3.196-4.4 4.987l-9.519 12.48c-2.017 2.645-2.884 5.918-2.439 9.216z" />
                                        <path
                                            d="m134.483 174.446c-3.138-2.68-7.856-2.308-10.537.831-27.082 31.716-41.996 72.123-41.996 113.778 0 96.734 78.698 175.432 175.432 175.432s175.432-78.698 175.432-175.432-78.698-175.432-175.432-175.432c-39.104 0-76.131 12.639-107.077 36.552-3.266 2.524-3.868 7.218-1.344 10.484 2.523 3.265 7.217 3.869 10.484 1.344 28.304-21.871 62.171-33.432 97.937-33.432 88.491 0 160.484 71.993 160.484 160.484s-71.993 160.484-160.484 160.484-160.484-71.993-160.484-160.484c0-38.099 13.643-75.059 38.415-104.071 2.681-3.139 2.309-7.857-.83-10.538z" />
                                        <path
                                            d="m257.382 164.113c-4.128 0-7.474 3.346-7.474 7.474v82.548c-13.703 2.93-24.515 13.742-27.445 27.445h-38.18c-4.128 0-7.474 3.346-7.474 7.474s3.346 7.474 7.474 7.474h38.18c3.446 16.115 17.791 28.238 34.919 28.238 19.692 0 35.712-16.021 35.712-35.712 0-17.128-12.123-31.473-28.238-34.919v-82.548c0-4.128-3.345-7.474-7.474-7.474zm20.764 124.942c0 11.449-9.314 20.764-20.764 20.764-11.449 0-20.764-9.315-20.764-20.764s9.315-20.764 20.764-20.764c11.45 0 20.764 9.315 20.764 20.764z" />
                                        <path
                                            d="m211.886 234.581c-3.774-1.669-8.188.034-9.86 3.809-2.087 4.713-6.76 7.758-11.907 7.758-5.146 0-9.82-3.045-11.906-7.758-1.671-3.776-6.087-5.48-9.86-3.809-3.775 1.671-5.48 6.085-3.809 9.86 4.479 10.118 14.518 16.655 25.575 16.655s21.096-6.537 25.575-16.655c1.671-3.775-.034-8.189-3.808-9.86z" />
                                        <path
                                            d="m324.645 261.096c11.057 0 21.096-6.537 25.576-16.655 1.671-3.775-.035-8.189-3.809-9.86-3.774-1.67-8.188.034-9.86 3.809-2.087 4.713-6.76 7.758-11.906 7.758s-9.82-3.045-11.905-7.757c-1.67-3.775-6.085-5.48-9.859-3.81-3.775 1.67-5.481 6.085-3.81 9.859 4.476 10.118 14.514 16.656 25.573 16.656z" />
                                        <path
                                            d="m178.983 316.261c-1.671-3.776-6.087-5.482-9.859-3.809-3.775 1.67-5.48 6.085-3.809 9.859 16.124 36.428 52.264 59.966 92.068 59.966s75.943-23.538 92.069-59.966c1.671-3.775-.035-8.189-3.809-9.86-3.774-1.67-8.188.034-9.86 3.809-13.733 31.023-44.507 51.069-78.4 51.069-33.894 0-64.668-20.045-78.4-51.068z" />
                                    </g>
                                </g>
                            </svg>
                            <h5 class="pt-4 pb-2 card-title">Flexible learning</h5>
                            <p class="card-text"></p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="text-center bg-transparent shadow-none card card-item rounded-0">
                        <div class="p-0 card-body">
                            <svg width="90" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m39 5c-6.065 0-11 4.935-11 11s4.935 11 11 11 11-4.935 11-11-4.935-11-11-11zm-4 15v-8l8 4z"
                                    fill="#f0bc5e"></path>
                                <path d="m36 38h-6v8h4v-4h2z" fill="#f0bc5e"></path>
                                <path d="m34 10.382v11.236l11.236-5.618zm2 3.236 4.764 2.382-4.764 2.382z"></path>
                                <path
                                    d="m58 1h-38c-2.757 0-5 2.243-5 5v19.509l-10.917 5.953c-.976.501-1.364 1.703-.865 2.681l.485.952c-.44.529-.703 1.191-.703 1.905v5.285c-1.228.669-2 2.442-2 3.715 0 1.654 1.346 3 3 3s3-1.346 3-3c0-1.273-.772-3.046-2-3.715v-5.285c0-.071.012-.14.026-.208.083.04.166.082.256.111.199.065.404.097.608.097.315 0 .632-.077.933-.231l.577-.315 1.844 3.703.773-.185c.022-.005.111-.027.251-.062.449 1.593 1.439 2.938 2.753 3.846-4.102 1.599-7.021 5.583-7.021 10.244v9h19v-5.333l.1.133c1.503 2.004 3.896 3.2 6.4 3.2s4.897-1.196 6.4-3.2l3.355-4.474c.48-.64.745-1.434.745-2.234v-.368c0-1.428-.817-2.656-2-3.281v-4.443h18c2.757 0 5-2.243 5-5v-32c0-2.757-2.243-5-5-5zm-41 5c0-1.654 1.346-3 3-3h38c1.654 0 3 1.346 3 3v23h-39.668l-.056-.113.641-.349c.976-.501 1.364-1.703.865-2.681l-.902-1.77c-.242-.476-.655-.827-1.162-.991-.507-.163-1.046-.118-1.541.135l-2.177 1.187zm-13 41c-.551 0-1-.448-1-1 0-.82.68-1.956.997-2 .323.044 1.003 1.18 1.003 2 0 .552-.449 1-1 1zm1.902-11.996-.883-1.774 15.08-8.233.901 1.769zm3.255.492 10.362-5.65 1.24 2.489c-.984.832-3.065 2.512-4.885 3.467-1.8.946-4.309 1.689-5.555 2.027zm3.041 3.874c1.38-.421 3.165-1.04 4.605-1.797 1.416-.744 2.923-1.844 4.057-2.739.728.888 1.14 2.002 1.14 3.166 0 2.757-2.243 5-5 5-2.27 0-4.203-1.514-4.802-3.63zm27.802 11.722c0 .37-.123.738-.345 1.035l-3.355 4.474c-1.127 1.502-2.922 2.399-4.8 2.399s-3.673-.897-4.8-2.399l-3.9-5.2-1.6 1.199 1.8 2.4v6h-15v-7c0-4.963 4.038-9 9-9h1.179c3.319 0 6.437 1.623 8.339 4.342l3.961 5.658h1.989l4.483-5.379c.329-.394.812-.621 1.325-.621.951 0 1.724.773 1.724 1.724zm-2-4.062c-1.003.075-1.936.53-2.585 1.31l-3.883 4.66-3.375-4.805c-.049-.07-.107-.13-.157-.198v-12.997h10zm20-6.03h-18v-4h19v-2h-19v-2h-14v12.86c-1.346-1.128-2.919-1.95-4.612-2.414 1.591-1.284 2.612-3.247 2.612-5.446 0-1.632-.578-3.194-1.599-4.437.149-.13.247-.216.267-.234l.567-.508-.907-1.821h38.672v7c0 1.654-1.346 3-3 3z">
                                </path>
                                <path d="m30 41h6v2h-6z"></path>
                                <path d="m30 45h4v2h-4z"></path>
                                <path d="m30 37h6v2h-6z"></path>
                                <path d="m19 13h2v2h-2z"></path>
                                <path d="m57 25h2v2h-2z"></path>
                                <path d="m57 21h2v2h-2z"></path>
                                <path d="m57 17h2v2h-2z"></path>
                                <path d="m21 7h8v-2h-8c-1.103 0-2 .897-2 2v4h2z"></path>
                            </svg>
                            <h5 class="pt-4 pb-2 card-title">Learn with experts</h5>
                            <p class="card-text"></p>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
            <div class="flex-wrap pt-3 btn-box d-flex align-items-center justify-content-center">
                <div>
                    <p class="pb-2">Are you student?</p>
                    <a href="https://lightboat.lightworks.co.jp/en-promotion"
                        class="btn theme-btn theme-btn-sm lh-24"><i class="mr-1 la la-file-text-o"></i>Start
                        Learning</a>
                </div>
            </div>
        </div><!-- end container -->
    </section><!-- end get-started-area -->
    <!-- ================================
       START GET STARTED AREA
================================= -->

    <!-- ================================
       START FUNFACT AREA
================================= -->
    <section class="overflow-hidden text-center funfact-area section--padding dot-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 responsive-column-half">
                    <div class="counter-item">
                        <div class="mb-3 shadow-sm counter__icon icon-element">
                            <svg class="svg-icon-color-1" width="40" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m499.5 422h-10v-304.92c0-20.678-16.822-37.5-37.5-37.5h-108.332v-27.962c0-28.462-23.156-51.618-51.618-51.618h-72.1c-28.462 0-51.618 23.156-51.618 51.618v27.962h-108.332c-20.678 0-37.5 16.822-37.5 37.5v304.92h-10c-6.893 0-12.5 5.607-12.5 12.5v34.549c0 23.683 19.268 42.951 42.951 42.951h426.098c23.683 0 42.951-19.268 42.951-42.951v-34.549c0-6.893-5.607-12.5-12.5-12.5zm-155.832-307.112h2.347c6.299 0 11.423 5.124 11.423 11.423 0 6.298-5.124 11.422-11.423 11.422h-2.347zm0 37.844h2.347c15.203.011 27.366-12.987 26.36-28.152h72.125v249.151h-18.64v-41.301c0-14.129-4.877-27.975-13.732-38.988-8.856-11.014-21.335-18.751-35.139-21.786l-67.199-14.761c-4.975-1.086-8.438-5.551-8.44-10.494v-12.896c25.347-15.384 42.318-43.248 42.318-75.002zm-144.678 120.228 6.441-1.415c6.113-1.344 11.335-4.877 14.948-9.642l24.143 17.74-15.434 15.434zm29.701 38.208-3.889 62.563h-123.662v-41.301c0-22 15.599-41.398 37.09-46.124l41.257-9.062 43.142 31.702c1.838 1.349 3.941 2.081 6.062 2.222zm57.691-64.029-30.382 22.325-30.382-22.325c.031-.624.058-5.717.033-6.388 9.461 3.502 19.686 5.419 30.35 5.419s20.888-1.917 30.35-5.419c-.013.671-.005 5.765.031 6.388zm-42.032 53.89 11.65-11.65 11.599 11.599 4.258 72.753h-32.027zm23.129-21.385 24.143-17.74c3.613 4.765 8.835 8.298 14.948 9.642l6.44 1.415-30.098 22.118zm21.894 29.3 43.14-31.701 41.256 9.062c21.492 4.726 37.091 24.124 37.091 46.124v41.302h-123.976l-3.662-62.561c2.151-.126 4.287-.857 6.151-2.226zm-106.041-194.309c10.817-.592 21.509-2.153 31.874-4.66 4.026-.974 6.501-5.027 5.527-9.054-.975-4.026-5.026-6.503-9.054-5.526-9.216 2.229-18.722 3.628-28.348 4.202v-47.979c.001-20.191 16.428-36.618 36.619-36.618h72.1c20.191 0 36.618 16.427 36.618 36.618v45.1c-6.201-2.706-12.011-6.201-17.336-10.485-7.358-5.922-13.503-13.088-18.26-21.298-1.673-2.89-4.521-4.86-7.814-5.407-3.288-.544-6.619.398-9.132 2.589-10.05 8.761-21.15 16.144-33.04 21.971-3.719 1.822-5.257 6.315-3.434 10.035 1.821 3.718 6.313 5.258 10.035 3.434 11.728-5.747 22.683-12.825 32.811-21.178 5.302 8.187 11.822 15.419 19.43 21.54 8.063 6.488 17.038 11.5 26.74 14.939v45.645c0 40.069-32.599 72.668-72.668 72.668s-72.668-32.599-72.668-72.668zm27.318 118.869v12.896c-.006 4.93-3.494 9.415-8.439 10.494l-67.201 14.761c-13.803 3.035-26.281 10.772-35.138 21.786-8.855 11.014-13.732 24.859-13.732 38.988v41.302h-18.64v-249.151h72.125c-1.022 15.115 11.132 28.186 26.36 28.152h2.347v5.77c0 31.754 16.971 59.619 42.318 75.002zm-56.087-107.193c0-6.299 5.124-11.423 11.423-11.423h2.347v22.845h-2.347c-6.299-.001-11.423-5.125-11.423-11.422zm342.437 342.738c0 15.412-12.539 27.951-27.951 27.951h-426.098c-15.412 0-27.951-12.539-27.951-27.951v-32.049h190.545v12.5c0 9.649 7.851 17.5 17.5 17.5h65.91c9.649 0 17.5-7.851 17.5-17.5v-12.5h72.043c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-340.998v-304.92c0-12.406 10.094-22.5 22.5-22.5h108.332v5.308h-2.347c-8.226 0-15.584 3.78-20.434 9.692h-81.551c-6.341 0-11.5 5.159-11.5 11.5v260.151c0 4.143 3.357 7.5 7.5 7.5h392c4.143 0 7.5-3.357 7.5-7.5v-260.151c0-6.341-5.159-11.5-11.5-11.5h-81.551c-4.85-5.913-12.208-9.692-20.434-9.692h-2.347v-5.308h108.332c12.406 0 22.5 10.094 22.5 22.5v304.92h-61.002c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h83.502zm-276.455-19.549v-12.5h70.91v12.5c0 1.379-1.121 2.5-2.5 2.5h-65.91c-1.379 0-2.5-1.121-2.5-2.5zm16.377-243.596c5.712 3.132 12.166 4.823 18.662 4.892 8.306.087 15.383-2.637 19.495-4.893 3.632-1.992 4.96-6.551 2.968-10.183s-6.549-4.961-10.183-2.968c-2.545 1.396-6.654 3.045-11.863 3.045-5.146 0-9.343-1.661-11.866-3.046-3.633-1.994-8.191-.661-10.183 2.97-1.991 3.633-.662 8.191 2.97 10.183zm-19.602-52.241c4.143 0 7.5-3.357 7.5-7.5v-15.472c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v15.472c0 4.143 3.358 7.5 7.5 7.5zm77.36 0c4.143 0 7.5-3.357 7.5-7.5v-15.472c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v15.472c0 4.143 3.357 7.5 7.5 7.5z" />
                                </g>
                            </svg>
                        </div>
                        <h4 class="counter__title counter text-color-2">255</h4>
                        <p class="counter__meta">expert instructors</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="counter-item">
                        <div class="mb-3 shadow-sm counter__icon icon-element">
                            <svg class="svg-icon-color-3" width="42" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 490.667 490.667"
                                xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M245.333,85.333c-41.173,0-74.667,33.493-74.667,74.667s33.493,74.667,74.667,74.667S320,201.173,320,160
                                                C320,118.827,286.507,85.333,245.333,85.333z M245.333,213.333C215.936,213.333,192,189.397,192,160
                                                c0-29.397,23.936-53.333,53.333-53.333s53.333,23.936,53.333,53.333S274.731,213.333,245.333,213.333z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M394.667,170.667c-29.397,0-53.333,23.936-53.333,53.333s23.936,53.333,53.333,53.333S448,253.397,448,224
                                                S424.064,170.667,394.667,170.667z M394.667,256c-17.643,0-32-14.357-32-32c0-17.643,14.357-32,32-32s32,14.357,32,32
                                                C426.667,241.643,412.309,256,394.667,256z"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M97.515,170.667c-29.419,0-53.333,23.936-53.333,53.333s23.936,53.333,53.333,53.333s53.333-23.936,53.333-53.333
                                                S126.933,170.667,97.515,170.667z M97.515,256c-17.643,0-32-14.357-32-32c0-17.643,14.357-32,32-32c17.643,0,32,14.357,32,32
                                                C129.515,241.643,115.157,256,97.515,256z"></path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M245.333,256c-76.459,0-138.667,62.208-138.667,138.667c0,5.888,4.779,10.667,10.667,10.667S128,400.555,128,394.667
                                                c0-64.704,52.629-117.333,117.333-117.333s117.333,52.629,117.333,117.333c0,5.888,4.779,10.667,10.667,10.667
                                                c5.888,0,10.667-4.779,10.667-10.667C384,318.208,321.792,256,245.333,256z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M394.667,298.667c-17.557,0-34.752,4.8-49.728,13.867c-5.013,3.072-6.635,9.621-3.584,14.656
                                                c3.093,5.035,9.621,6.635,14.656,3.584C367.637,323.712,380.992,320,394.667,320c41.173,0,74.667,33.493,74.667,74.667
                                                c0,5.888,4.779,10.667,10.667,10.667c5.888,0,10.667-4.779,10.667-10.667C490.667,341.739,447.595,298.667,394.667,298.667z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M145.707,312.512c-14.955-9.045-32.149-13.845-49.707-13.845c-52.928,0-96,43.072-96,96
                                                c0,5.888,4.779,10.667,10.667,10.667s10.667-4.779,10.667-10.667C21.333,353.493,54.827,320,96,320
                                                c13.675,0,27.029,3.712,38.635,10.752c5.013,3.051,11.584,1.451,14.656-3.584C152.363,322.133,150.741,315.584,145.707,312.512z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h4 class="counter__title counter text-color-4">1,000</h4>
                        <p class="counter__meta">candidates enrolled</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="counter-item">
                        <div class="mb-3 shadow-sm counter__icon icon-element">
                            <svg class="svg-icon-color-4" width="40" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m181.022 142.59-8.659 3.138c-13.364 4.846-23.334 16.536-26.021 30.517l-2.938 15.396c-1.466 7.626.53 15.436 5.479 21.425 4.951 5.995 12.251 9.433 20.025 9.433h75.057c7.714 0 14.977-3.393 19.927-9.309 4.946-5.911 7.004-13.65 5.646-21.233l-2.74-15.315c-2.539-14.201-12.542-26.081-26.108-31.004l-9.18-3.327v-13.53c0-.38-.037-.75-.092-1.115 6.697-6.818 10.533-16.115 10.533-25.627v-20.159c0-19.678-16.01-35.687-35.689-35.687s-35.692 16.009-35.692 35.687v20.787c0 9.778 4.032 18.705 10.515 25.188-.038.304-.063.611-.063.925zm71.008 36.692 2.74 15.317c.574 3.201-.295 6.468-2.384 8.964-2.092 2.5-5.162 3.935-8.423 3.935h-75.057c-3.285 0-6.369-1.452-8.461-3.985-2.088-2.528-2.931-5.823-2.311-9.05l2.938-15.396c1.693-8.812 7.979-16.183 16.4-19.236l5.672-2.055c.142.146.285.293.439.428 6.463 5.651 14.57 8.477 22.682 8.476 8.102 0 16.207-2.82 22.671-8.46.233-.203.447-.422.651-.65l5.983 2.169c8.554 3.102 14.86 10.59 16.46 19.543zm-66.46-97.402c0-11.406 9.281-20.687 20.689-20.687 9.628 0 17.718 6.62 20.015 15.54-.964.471-1.953.916-2.966 1.321-9.222 3.692-16.671 3.202-18.8 1.71-3.392-2.378-8.068-1.558-10.447 1.834-2.378 3.392-1.557 8.068 1.834 10.447 3.663 2.569 8.635 3.853 14.309 3.853 5.155 0 10.89-1.071 16.745-3.19v9.329c0 5.733-2.371 11.347-6.506 15.402-1.914 1.878-4.107 3.333-6.462 4.337-.165.063-.327.131-.486.205-2.419.957-5.003 1.438-7.644 1.369-11.184-.215-20.281-9.494-20.281-20.684zm19.993 56.469c.229.004.456.006.685.006 3.519 0 6.967-.529 10.261-1.544v11.999c-6.251 3.854-14.242 3.852-20.485-.006v-11.971c3.034.919 6.231 1.452 9.539 1.516z" />
                                    <path
                                        d="m88.264 350.904h233.57c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-233.57c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5z" />
                                    <path
                                        d="m88.264 391.345h233.57c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-233.57c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5z" />
                                    <path
                                        d="m88.264 431.784h233.57c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-233.57c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5z" />
                                    <path
                                        d="m88.264 472.225h233.57c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-233.57c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5z" />
                                    <path
                                        d="m80.764 262.524c0 4.143 3.357 7.5 7.5 7.5h233.57c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-233.57c-4.143 0-7.5 3.358-7.5 7.5z" />
                                    <path
                                        d="m88.264 310.464h233.57c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-233.57c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5z" />
                                    <path
                                        d="m60.569 350.932c4.158 0 7.529-3.37 7.529-7.528 0-4.157-3.371-7.528-7.529-7.528s-7.528 3.37-7.528 7.528 3.371 7.528 7.528 7.528z" />
                                    <path
                                        d="m60.569 270.052c4.158 0 7.529-3.37 7.529-7.528s-3.371-7.528-7.529-7.528-7.528 3.37-7.528 7.528 3.371 7.528 7.528 7.528z" />
                                    <path
                                        d="m60.569 310.492c4.158 0 7.529-3.37 7.529-7.528s-3.371-7.528-7.529-7.528-7.528 3.37-7.528 7.528 3.371 7.528 7.528 7.528z" />
                                    <path
                                        d="m60.569 391.372c4.158 0 7.529-3.37 7.529-7.528s-3.371-7.528-7.529-7.528-7.528 3.37-7.528 7.528 3.371 7.528 7.528 7.528z" />
                                    <path
                                        d="m60.569 431.813c4.158 0 7.529-3.37 7.529-7.528s-3.371-7.528-7.529-7.528-7.528 3.37-7.528 7.528c0 4.157 3.371 7.528 7.528 7.528z" />
                                    <path
                                        d="m60.569 472.253c4.158 0 7.529-3.37 7.529-7.528 0-4.157-3.371-7.528-7.529-7.528s-7.528 3.37-7.528 7.528c0 4.157 3.371 7.528 7.528 7.528z" />
                                    <path
                                        d="m485.63 118.121c-3.026-3.83-5.886-7.449-7.269-10.783-1.492-3.599-2.08-8.354-2.702-13.39-1.091-8.822-2.327-18.821-9.305-25.798s-16.978-8.213-25.8-9.304c-5.037-.622-9.794-1.21-13.393-2.702-3.335-1.383-6.953-4.241-10.784-7.268-5.271-4.165-11.068-8.738-17.922-10.813v-2.269c.001-19.736-16.058-35.794-35.797-35.794h-312.444c-19.739 0-35.798 16.058-35.798 35.795v28.949c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-28.949c0-11.467 9.33-20.795 20.798-20.795h312.444c11.468 0 20.798 9.328 20.798 20.795v2.27c-6.852 2.076-12.647 6.647-17.918 10.812-3.831 3.026-7.449 5.885-10.783 7.268-3.599 1.491-8.356 2.079-13.393 2.702-8.822 1.09-18.821 2.326-25.8 9.303-6.979 6.978-8.215 16.977-9.306 25.799-.622 5.035-1.21 9.791-2.702 13.39-1.383 3.334-4.242 6.953-7.269 10.783-5.604 7.091-11.954 15.128-11.954 25.417s6.351 18.326 11.954 25.417c3.026 3.83 5.886 7.449 7.269 10.783 1.492 3.599 2.08 8.354 2.702 13.391 1.091 8.821 2.327 18.82 9.305 25.797 6.978 6.978 16.978 8.213 25.8 9.304 2.63.325 5.179.644 7.532 1.084v113.367c0 4.443 2.48 8.411 6.473 10.355 3.992 1.947 8.645 1.453 12.146-1.288l15.943-12.483v136.94c0 11.467-9.33 20.795-20.798 20.795h-312.443c-11.468 0-20.798-9.328-20.798-20.795v-378.435c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v378.434c0 19.737 16.059 35.795 35.798 35.795h312.444c19.739 0 35.798-16.058 35.798-35.795v-136.94l15.943 12.482c2.081 1.63 4.571 2.466 7.089 2.466 1.716 0 3.444-.389 5.064-1.178 3.994-1.944 6.476-5.912 6.476-10.354v-83.697c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v76.555l-19.937-15.609c-2.015-1.595-4.549-2.474-7.136-2.474s-5.121.879-7.104 2.448l-19.959 15.627v-98.625c.544.426 1.091.857 1.645 1.294 7.092 5.604 15.13 11.953 25.42 11.953 10.289 0 18.327-6.35 25.419-11.952 3.831-3.026 7.45-5.886 10.784-7.269 3.599-1.491 8.356-2.079 13.393-2.702 8.822-1.09 18.821-2.326 25.801-9.303 6.977-6.978 8.213-16.977 9.304-25.798.623-5.036 1.211-9.792 2.703-13.391 1.383-3.334 4.242-6.953 7.269-10.783 5.604-7.091 11.954-15.128 11.954-25.417s-6.351-18.326-11.954-25.417zm-11.769 41.534c-3.528 4.465-7.176 9.081-9.355 14.337-2.273 5.48-3.016 11.487-3.734 17.296-.871 7.046-1.693 13.701-5.023 17.031-3.331 3.33-9.987 4.152-17.034 5.023-5.81.718-11.816 1.46-17.298 3.733-5.256 2.179-9.872 5.826-14.337 9.354-5.679 4.485-11.042 8.723-16.121 8.723s-10.442-4.237-16.121-8.723c-4.465-3.527-9.081-7.175-14.337-9.354-.362-.15-1.618-.628-1.889-.712-4.957-1.724-10.26-2.385-15.41-3.021-7.047-.871-13.703-1.694-17.034-5.024-3.329-3.329-4.152-9.984-5.023-17.029-.718-5.81-1.46-11.815-3.733-17.297-2.18-5.256-5.827-9.872-9.355-14.337-4.485-5.678-8.723-11.04-8.723-16.117s4.237-10.439 8.723-16.117c3.528-4.465 7.176-9.081 9.355-14.337 2.273-5.48 3.016-11.487 3.733-17.296.871-7.046 1.694-13.701 5.024-17.031 3.331-3.33 9.987-4.152 17.034-5.023 5.81-.718 11.816-1.46 17.298-3.733 5.256-2.179 9.872-5.826 14.337-9.354 5.667-4.477 11.021-8.705 16.091-8.721.009 0 .019.001.028.001.01 0 .02-.001.03-.001 5.071.015 10.425 4.244 16.093 8.721 4.465 3.527 9.081 7.175 14.337 9.354 5.481 2.273 11.489 3.016 17.299 3.733 7.047.871 13.703 1.694 17.033 5.024s4.153 9.984 5.024 17.03c.718 5.809 1.46 11.815 3.733 17.296 2.18 5.256 5.827 9.872 9.355 14.337 4.485 5.678 8.723 11.04 8.723 16.117s-4.237 10.44-8.723 16.117z" />
                                    <path
                                        d="m439.109 119.704-25.522-7.221-14.757-22.04c-1.763-2.632-4.705-4.202-7.872-4.202s-6.11 1.571-7.872 4.202l-14.757 22.04-25.524 7.222c-3.048.863-5.452 3.178-6.43 6.19s-.392 6.297 1.566 8.783l16.403 20.843-1.018 26.497c-.123 3.166 1.333 6.168 3.896 8.031 1.645 1.195 3.594 1.813 5.565 1.813 1.102 0 2.21-.193 3.274-.585l24.895-9.158 24.893 9.157c2.973 1.096 6.276.636 8.839-1.225s4.021-4.862 3.899-8.029l-1.018-26.502 16.404-20.843c1.958-2.489 2.543-5.772 1.564-8.784-.975-3.012-3.379-5.326-6.428-6.189zm-24.587 28.143c-1.386 1.764-2.103 3.97-2.018 6.219l.778 20.284-19.053-7.009c-2.111-.777-4.436-.776-6.543-.001l-19.055 7.01.779-20.291c.084-2.241-.634-4.447-2.023-6.217l-12.554-15.952 19.539-5.527c2.161-.613 4.04-1.979 5.289-3.845l11.295-16.87 11.294 16.868c1.25 1.867 3.129 3.233 5.294 3.848l19.535 5.526z" />
                                </g>
                            </svg>
                        </div>
                        <h4 class="counter__title counter text-color-5">41</h4>
                        <p class="counter__meta">years of experience</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end funfact-area -->
    <!-- ================================
       START FUNFACT AREA
================================= -->

    <!--======================================
        START CTA AREA
======================================-->
    <section class="cat-area section-padding img-bg">
        <div class="overlay"></div>
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <span class="ring-shape ring-shape-7"></span>
        <div class="container">
            <div class="text-center cta-content-wrap position-relative">
                <div class="section-heading">
                    <h2 class="text-white section__title fs-40 lh-60">Why so late? Start one of our exams today!</h2>
                </div><!-- end section-heading -->
                <div class="cat-btn-box mt-35px">
                    <a href="{{ route('register') }}" class="btn theme-btn theme-btn-white">Get Started <i
                            class="ml-1 la la-arrow-right icon"></i></a>
                </div><!-- end cat-btn-box -->
            </div><!-- end cta-content-wrap -->
        </div><!-- end container -->
    </section><!-- end cta-area -->
    <!--======================================
        END CTA AREA
======================================-->

    <!-- ================================
       START CLIENT-LOGO AREA
================================= -->
    <section class="overflow-hidden text-center client-logo-area section-padding position-relative">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="section-heading">
                <h2 class="mb-3 section__title">Trusted by Academia & Industry (BASIS)</h2>
                <p class="section__desc">Get access to high quality learning wherever you are
                </p>
            </div><!-- end section-heading -->
            {{-- <div class="client-logo-carousel mt-40px">
                <a href="#" class="client-logo-item"><img src="{{ asset('aduca/images/sponsor-img.png') }}"
                        alt="brand image"></a>
                <a href="#" class="client-logo-item"><img src="{{ asset('aduca/images/sponsor-img2.png') }}"
                        alt="brand image"></a>
                <a href="#" class="client-logo-item"><img src="{{ asset('aduca/images/sponsor-img3.png') }}"
                        alt="brand image"></a>
                <a href="#" class="client-logo-item"><img src="{{ asset('aduca/images/sponsor-img4.png') }}"
                        alt="brand image"></a>
                <a href="#" class="client-logo-item"><img src="{{ asset('aduca/images/sponsor-img5.png') }}"
                        alt="brand image"></a>
            </div><!-- end client-logo-carousel --> --}}
        </div><!-- end container -->
    </section><!-- end client-logo-area -->
    <!-- ================================
       START CLIENT-LOGO AREA
================================= -->

    <!--======================================
        START GET STARTED AREA
======================================-->
    <section class="get-started-area section--padding position-relative bg-gray">
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 responsive-column-half">
                    <div class="card card-item hover-y">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('aduca/images/small-img-3.jpg') }}" alt="card image"
                                    class="rounded-full img-fluid">
                            </div>
                            <div class="pl-4">
                                <h5 class="pt-4 pb-2 card-title">Become a Partner</h5>
                                <p class="card-text">Created by experts, Coursector library of trusted practice and
                                    lessons covers ICT.</p>
                                <div class="btn-box mt-20px">
                                </div><!-- end btn-box -->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-6 responsive-column-half">
                    <div class="card card-item hover-y">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('aduca/images/small-img-4.jpg') }}" alt="card image"
                                    class="rounded-full img-fluid">
                            </div>
                            <div class="pl-4">
                                <h5 class="pt-4 pb-2 card-title">Become a Learner</h5>
                                <p class="card-text">Created by experts, Coursector library of trusted practice and
                                    lessons covers ICT.</p>
                                <div class="btn-box mt-20px">
                                    <a href="{{ route('register') }}" class="btn theme-btn theme-btn-sm lh-30"><i
                                            class="mr-1 la la-file-text-o"></i>Start Learning</a>
                                </div><!-- end btn-box -->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </section><!-- end get-started-area -->
    <!-- ================================
       START GET STARTED AREA
================================= -->

    <!-- ================================
         END FOOTER AREA
================================= -->
    <section class="footer-area pt-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="pb-2 fs-20 font-weight-semi-bold">Company</h3>
                        <div class="divider border-bottom-0"><span></span></div>
                        <ul class="generic-list-item">
                            <li><a href="https://www.bcc.gov.bd">About us</a></li>
                            <li><a href="mailto:info@bditec.gov.bd">Contact us</a></li>
                            <li><a href="tel:+8801857321122">Support</a></li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="pb-2 fs-20 font-weight-semi-bold">Courses</h3>
                        <div class="divider border-bottom-0"><span></span></div>
                        <ul class="generic-list-item">
                            <li><a href="https://lightboat.lightworks.co.jp/en-promotion">Become a Learner</a></li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="pb-2 fs-20 font-weight-semi-bold">Download App</h3>
                        <div class="divider border-bottom-0"><span></span></div>
                        <div class="mobile-app">
                            <p class="pb-3 lh-24">Download our mobile app and learn on the go.</p>
                            <a href="https://play.google.com/store/apps/details?id=com.tns.itee_exam_app"
                                class="d-block hover-s"><img src="{{ asset('aduca/images/googleplay.png') }}"
                                    alt="Google play store" class="img-fluid"></a>
                        </div>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="section-block"></div>
        <div class="py-4 copyright-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="flex-wrap d-flex align-items-center">
                            <a href="index.html" class="pr-4">
                                <img src="{{ asset('aduca/images/logoBDITEC.png') }}" alt="footer logo"
                                    class="footer__logo">
                            </a>
                            <p class="copy-desc">Copyright &copy; 2024 BCC</p>
                        </div>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="flex-wrap d-flex align-items-center justify-content-end">
                        </div>
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end copyright-content -->
    </section><!-- end footer-area -->
    <!-- ================================
          END FOOTER AREA
================================= -->

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <div class="tooltip_templates">
        @foreach ($examFees as $examFee)
            <div id="tooltip_content_{{ $examFee->exam_category->id }}">
                <div class="card card-item">
                    <div class="card-body">
                        <h5 class="pb-1 card-title">{{ $examFee->exam_type->name }}
                        </h5>
                        <p class="pt-1 card-text fs-14 lh-22">{{ $examFee->exam_category->name }}</p>
                        <div class="pt-1 d-flex justify-content-between align-items-center">
                            <a href="{{ route('register') }}" class="mr-3 btn theme-btn flex-grow-1"><i
                                    class="mr-1 la la-shopping-cart fs-18"></i> Register</a>

                        </div>
                    </div>
                </div><!-- end card -->
            </div>
        @endforeach
    </div><!-- end tooltip_templates -->


    <!-- template js files -->
    <script src="{{ asset('aduca/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('aduca/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('aduca/js/isotope.js') }}"></script>
    <script src="{{ asset('aduca/js/waypoint.min.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('aduca/js/fancybox.js') }}"></script>
    <script src="{{ asset('aduca/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('aduca/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('aduca/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('aduca/js/main.js') }}"></script>
</body>

</html>
