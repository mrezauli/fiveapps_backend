<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="authr" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    @include('examinee.favicon') <!-- Including the sidebar -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/tooltipster.bundle.css') }}">
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
    <header class="bg-white header-menu-area">
        <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray">
        </div><!-- end header-top -->
        <div class="bg-white header-menu-content pr-150px pl-150px">
            <div class="container-fluid">
                <div class="main-menu-content">
                    <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="logo-box justify-content-between">
                                <a href="{{ url('/') }}" class="logo"><img
                                        src="{{ asset('aduca/images/logo.png') }}" alt="logo"></a>
                                <div class="user-btn-action">
                                    <div class="shadow-sm off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm"
                                        data-toggle="tooltip" data-placement="top" title="Main menu">
                                        <i class="la la-bars"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                        <div class="col-lg-9">
                            <div class="menu-wrapper">
                                <nav class="main-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ url('/') }}">Home</a>
                                        </li>
                                    </ul><!-- end ul -->
                                </nav><!-- end main-menu -->
                                @if (Route::has('login'))
                                    @auth
                                        <div class="nav-right-button">
                                            <a href="{{ route('dashboard') }}"
                                                class="mr-2 btn theme-btn theme-btn-sm lh-26 theme-btn-white"><i
                                                    class="mr-1 la la-dashboard"></i> Dashboard</a>
                                        </div>
                                    @else
                                        <div class="nav-right-button">
                                            <a href="{{ route('login') }}"
                                                class="mr-2 btn theme-btn theme-btn-sm lh-26 theme-btn-transparent"><i
                                                    class="mr-1 la la-sign-in"></i> Login</a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                    class="shadow-none btn theme-btn theme-btn-sm lh-26"><i
                                                        class="mr-1 la la-plus"></i> Sign up</a>
                                            @endif
                                        </div><!-- end nav-right-button -->
                                    @endauth
                                @endif
                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-9 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container-fluid -->
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
                        <a href="{{ route('dashboard') }}" class="mr-2 btn theme-btn theme-btn-sm lh-26 theme-btn-white"><i
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
            </div>
        </div><!-- end off-canvas-menu -->
    </header><!-- end header-menu-area -->
    <!--======================================
        END HEADER AREA
======================================-->

    <!--================================
         START HERO AREA
=================================-->
    <section class="hero-area bg-gray hero-area-4">
        <div class="hero-slider-item after-none">
            <div class="container">
                <div class="text-center hero-content">
                    <div class="section-heading">
                        <h2 class="pb-3 section__title fs-60 lh-80 theme-font-2">Welcome to ITEE Exam Registration
                            System</h2>
                    </div><!-- end section-heading -->
                </div><!-- end hero-content -->
            </div><!-- end container -->
        </div><!-- end hero-slider-item -->
    </section><!-- end hero-area -->
    <!--================================
        END HERO AREA
=================================-->

    <!--======================================
        START FEATURE AREA
 ======================================-->
    <section class="feature-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 responsive-column-half">
                    <div class="info-box info--box hover-y">
                        <div class="icon-element bg-1">
                            <svg class="svg-icon-color-white" viewBox="0 0 74 74" width="40"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m31.841 26.02a1 1 0 0 1 -.52-1.855l2.59-1.57a1 1 0 1 1 1.037 1.71l-2.59 1.57a1 1 0 0 1 -.517.145z" />
                                <path
                                    d="m57.42 58.09a.985.985 0 0 1 -.294-.045l-20.09-6.179a1 1 0 0 1 -.546-1.5l26.054-40.382-39.324 38.55a1 1 0 0 1 -1.087.208l-16.76-7.03a1 1 0 0 1 -.131-1.777l11.358-6.871a1 1 0 0 1 1.035 1.711l-9.675 5.853 14.334 6.013 39.106-38.341-20.363 12.316a1 1 0 0 1 -1.037-1.716l27.709-16.747a1 1 0 0 1 .372-.14s0 0 0 0a.986.986 0 0 1 .156-.013 1 1 0 0 1 .609.206l.079.067a1 1 0 0 1 .312.713 1.023 1.023 0 0 1 -.023.227l-10.814 54.073a1 1 0 0 1 -.98.8zm-18.533-7.747 17.769 5.466 9.572-47.844z" />
                                <path
                                    d="m23.221 31.23a1 1 0 0 1 -.519-1.856l2.53-1.53a1 1 0 0 1 1.036 1.712l-2.531 1.53a1 1 0 0 1 -.516.144z" />
                                <path
                                    d="m28.7 72h-.072a1 1 0 0 1 -.894-.74l-6.178-23.184a1 1 0 1 1 1.931-.515l5.438 20.389 7.488-17.435a1 1 0 1 1 1.838.789l-8.629 20.096a1 1 0 0 1 -.922.6z" />
                                <path
                                    d="m28.709 72a1 1 0 0 1 -.736-1.677l16.092-17.515a1 1 0 0 1 1.473 1.354l-16.093 17.515a1 1 0 0 1 -.736.323z" />
                            </svg>
                        </div>
                        <h3 class="info__title theme-font-2 font-weight-bold">Limited Access</h3>
                        <p class="info__text">Applicant can register for either IP or FE Exam only
                        </p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-6 -->

                <div class="col-lg-6 responsive-column-half">
                    <div class="info-box info--box hover-y">
                        <div class="icon-element bg-3">
                            <svg class="svg-icon-color-white" width="35" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512"
                                xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M458.406,380.681c-8.863-6.593-21.391-4.752-27.984,4.109c-3.626,4.874-7.506,9.655-11.533,14.21
                                            c-7.315,8.275-6.538,20.915,1.737,28.231c3.806,3.364,8.531,5.016,13.239,5.016c5.532,0,11.04-2.283,14.992-6.754
                                            c4.769-5.394,9.364-11.056,13.658-16.829C469.108,399.803,467.269,387.273,458.406,380.681z" />
                                            <path
                                                d="M491.854,286.886c-10.786-2.349-21.447,4.496-23.796,15.288c-1.293,5.937-2.855,11.885-4.646,17.681
                                            c-3.261,10.554,2.651,21.752,13.204,25.013c1.967,0.607,3.955,0.896,5.911,0.896c8.54,0,16.448-5.514,19.102-14.102
                                            c2.126-6.878,3.98-13.937,5.514-20.98C509.492,299.89,502.647,289.236,491.854,286.886z" />
                                            <path
                                                d="M362.139,444.734c-5.31,2.964-10.808,5.734-16.34,8.233c-10.067,4.546-14.542,16.392-9.996,26.459
                                            c3.34,7.396,10.619,11.773,18.239,11.773c2.752,0,5.549-0.571,8.22-1.777c6.563-2.964,13.081-6.249,19.377-9.764
                                            c9.645-5.384,13.098-17.568,7.712-27.212C383.968,442.803,371.784,439.35,362.139,444.734z" />
                                            <path d="M236,96v151.716l-73.339,73.338c-7.81,7.811-7.81,20.474,0,28.284c3.906,3.906,9.023,5.858,14.143,5.858
                                            c5.118,0,10.237-1.953,14.143-5.858l79.196-79.196c3.75-3.75,5.857-8.838,5.857-14.142V96c0-11.046-8.954-20-20-20
                                            C244.954,76,236,84.954,236,96z" />
                                            <path d="M492,43c-11.046,0-20,8.954-20,20v55.536C425.448,45.528,344.151,0,256,0C187.62,0,123.333,26.629,74.98,74.98
                                            C26.629,123.333,0,187.62,0,256s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512c0.169,0,0.332-0.021,0.5-0.025
                                            c0.168,0.004,0.331,0.025,0.5,0.025c7.208,0,14.487-0.304,21.637-0.902c11.007-0.922,19.183-10.592,18.262-21.599
                                            c-0.923-11.007-10.58-19.187-21.6-18.261C269.255,471.743,263.099,472,257,472c-0.169,0-0.332,0.021-0.5,0.025
                                            c-0.168-0.004-0.331-0.025-0.5-0.025c-119.103,0-216-96.897-216-216S136.897,40,256,40c76.758,0,147.357,40.913,185.936,106
                                            h-54.993c-11.046,0-20,8.954-20,20s8.954,20,20,20H448c12.18,0,23.575-3.423,33.277-9.353c0.624-0.356,1.224-0.739,1.796-1.152
                                            C500.479,164.044,512,144.347,512,122V63C512,51.954,503.046,43,492,43z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h3 class="info__title theme-font-2 font-weight-bold">On your schedule</h3>
                        <p class="info__text">
                            Registration period: 1 Sep 2024 to 30 Sep 2024
                            <br />
                        </p>
                    </div><!-- end info-box -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end feature-area -->
    <!--======================================
       END FEATURE AREA
======================================-->

    <!--======================================
        START COURSE AREA
======================================-->
    <section class="course-area section--padding bg-radial-gradient-gray position-relative">
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <span class="ring-shape ring-shape-7"></span>
        <div class="container">
            <div class="text-center section-heading">
                <h2 class="section__title theme-font-2">Featured Exam</h2>
            </div><!-- end section-heading -->
            <div class="mx-auto col-lg-10 mt-50px">
                <div class="featured-course-carousel owl-action-styled owl--action-styled">
                    @foreach ($examFees as $examFee)
                        <div class="border shadow-none card card-item card-item-list-layout border-gray">
                            <div class="card-image">
                                <a href="course-details.html" class="d-block">
                                    <?php $imageUrl = $examFee->exam_type->image; ?>
                                    <img class="card-img-top" src="{{ asset($imageUrl) }}" alt="Card image cap">
                                </a>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h5 class="pb-1 card-title"><a
                                        href="course-details.html">{{ $examFee->exam_type->name }}</a></h5>
                                <p class="pb-1 card-text lh-24">{{ $examFee->exam_category->name }}</p>
                                <div class="pb-2 rating-wrap d-flex align-items-center">
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-black card-price font-weight-bold">BDT {{ $examFee->fee }} (৳)</p>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    @endforeach
                </div><!-- end featured-course-carousel -->
            </div><!-- end col-lg-10 -->
        </div><!-- end container -->
    </section><!-- end courses-area -->
    <!--======================================
        END COURSE AREA
======================================-->





    <!--======================================
        START BENEFIT AREA
======================================-->
    <section class="benefit-area section--padding">
        <div class="course-wrapper">
            <div class="container">
                <div class="text-center section-heading">
                    <h2 class="pb-3 section__title theme-font-2">Don't waste your valuable time or money</h2>
                </div><!-- end section-heading -->
                <div class="row pt-50px">
                    <div class="col-lg-3 responsive-column-half">
                        <div class="info-box info--box info--box-2 hover-s border-red">
                            <div class="icon-element icon-element-md bg-1">
                                <svg class="svg-icon-color-white" width="30" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545
                                            c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273
                                            c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909
                                            C500.364,283.927,495.709,279.273,488.727,279.273z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727
                                            v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727
                                            C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545
                                            h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636
                                            h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473
                                            c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636
                                            s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636
                                            c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="info__title theme-font-2 font-weight-bold fs-20 lh-28">Get real employable
                                skills</h3>
                            <p class="info__text">Master skills, unlock opportunities.
                            <p>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 responsive-column-half">
                        <div class="info-box info--box info--box-2 hover-s border-purple">
                            <div class="icon-element icon-element-md bg-2">
                                <svg class="svg-icon-color-white" width="30" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 432.4 432.4"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M216.529,93.2c-61.2,0-111.2,50-111.2,111.2c0,32,14,62.8,37.6,83.6c17.6,17.6,16,55.2,15.6,55.6
                                                c0,2,0.4,3.6,2,5.2c1.2,1.2,3.2,2,4.8,2h102c2,0,3.6-0.8,4.8-2c1.2-1.2,2-3.2,2-5.2c0-0.4-2-38,15.6-55.6
                                                c0.4-0.4,0.8-0.8,1.2-1.2c23.2-21.2,36.8-51.2,36.8-82.4C327.729,143.2,277.729,93.2,216.529,93.2z M280.529,277.6
                                                c-0.4,0.4-1.2,1.2-1.2,1.6c-15.6,16.8-18.4,44.4-18.8,57.6h-88.4c-0.4-13.2-3.2-42-20-59.2c-21.2-18.4-33.6-45.2-33.6-73.6
                                                c0-54,43.6-97.6,97.6-97.6s97.6,43.6,97.6,97.6C313.729,232.4,301.729,259.2,280.529,277.6z" />
                                                <path
                                                    d="M216.129,121.6c-3.6,0-6.8,3.2-6.8,6.8c0,3.6,3.2,6.8,6.8,6.8c40.4,0,72.8,32.8,72.8,72.8
                                                c0,3.6,3.2,6.8,6.8,6.8c3.6,0,6.8-3.2,6.8-6.8C302.929,160.4,264.129,121.6,216.129,121.6z" />
                                                <path
                                                    d="M260.529,358.4h-88.8c-9.2,0-16.8,7.6-16.8,16.8s7.6,16.8,16.8,16.8h88.4
                                                c9.6-0.4,17.2-7.6,17.2-16.8C277.329,366,269.729,358.4,260.529,358.4z M260.529,378h-88.8c-1.6,0-3.2-1.2-3.2-3.2
                                                s1.2-3.2,3.2-3.2h88.4c1.6,0,3.2,1.2,3.2,3.2S262.129,378,260.529,378z" />
                                                <path
                                                    d="M247.329,398.8h-62.4c-9.2,0-16.8,7.6-16.8,16.8s7.6,16.8,16.8,16.8h62.4
                                                c9.2,0,16.8-7.6,16.8-16.8C264.129,406,256.529,398.8,247.329,398.8z M247.329,418.4h-62.4c-1.6,0-3.2-1.2-3.2-3.2
                                                s1.2-3.2,3.2-3.2h62.4c1.6,0,3.2,1.2,3.2,3.2S248.929,418.4,247.329,418.4z" />
                                                <path d="M216.129,60c4,0,6.8-3.2,6.8-6.8V6.8c0-3.6-3.2-6.8-6.8-6.8c-3.6,0-6.8,3.2-6.8,6.8v46.4
                                                C209.329,56.8,212.529,60,216.129,60z" />
                                                <path
                                                    d="M329.329,34.4c-3.2-2.4-7.2-1.2-9.2,1.6l-25.6,38.4c-2.4,3.2-1.6,7.6,1.6,9.6
                                                c1.2,0.8,2.4,1.2,3.6,1.2c2.4,0,4.4-1.2,5.6-3.2l25.6-38.4C333.329,40.8,332.529,36.4,329.329,34.4z" />
                                                <path d="M134.929,83.6c1.2,0,2.4-0.4,3.6-1.2c3.2-2,4-6.4,2-9.6l-24.8-38.8c-2-3.2-6.4-4-9.6-2
                                                s-4,6.4-2,9.6l24.8,38.8C130.529,82.8,132.529,83.6,134.929,83.6z" />
                                                <path
                                                    d="M86.529,126l-40.4-22c-3.2-1.6-7.6-0.4-9.2,2.8c-2,3.2-0.8,7.6,2.8,9.2l40.4,22
                                                c1.2,0.4,2,0.8,3.2,0.8c2.4,0,4.8-1.2,6-3.6C90.929,132,89.729,127.6,86.529,126z" />
                                                <path
                                                    d="M395.729,106.8c-1.6-3.2-6-4.4-9.2-2.8l-40.8,22c-3.2,1.6-4.4,6-2.8,9.2c1.2,2.4,3.6,3.6,6,3.6
                                                c1.2,0,2.4-0.4,3.2-0.8l40.8-22C396.129,114.4,397.329,110,395.729,106.8z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="info__title theme-font-2 font-weight-bold fs-20 lh-28">Project-based, active
                                learning</h3>
                            <p class="info__text">Learn by doing, <br />excel faster.
                            <p>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 responsive-column-half">
                        <div class="info-box info--box info--box-2 hover-s border-yellow">
                            <div class="icon-element icon-element-md bg-3">
                                <svg class="svg-icon-color-white" width="28" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M458.406,380.681c-8.863-6.593-21.391-4.752-27.984,4.109c-3.626,4.874-7.506,9.655-11.533,14.21
                                            c-7.315,8.275-6.538,20.915,1.737,28.231c3.806,3.364,8.531,5.016,13.239,5.016c5.532,0,11.04-2.283,14.992-6.754
                                            c4.769-5.394,9.364-11.056,13.658-16.829C469.108,399.803,467.269,387.273,458.406,380.681z" />
                                                <path
                                                    d="M491.854,286.886c-10.786-2.349-21.447,4.496-23.796,15.288c-1.293,5.937-2.855,11.885-4.646,17.681
                                            c-3.261,10.554,2.651,21.752,13.204,25.013c1.967,0.607,3.955,0.896,5.911,0.896c8.54,0,16.448-5.514,19.102-14.102
                                            c2.126-6.878,3.98-13.937,5.514-20.98C509.492,299.89,502.647,289.236,491.854,286.886z" />
                                                <path
                                                    d="M362.139,444.734c-5.31,2.964-10.808,5.734-16.34,8.233c-10.067,4.546-14.542,16.392-9.996,26.459
                                            c3.34,7.396,10.619,11.773,18.239,11.773c2.752,0,5.549-0.571,8.22-1.777c6.563-2.964,13.081-6.249,19.377-9.764
                                            c9.645-5.384,13.098-17.568,7.712-27.212C383.968,442.803,371.784,439.35,362.139,444.734z" />
                                                <path d="M236,96v151.716l-73.339,73.338c-7.81,7.811-7.81,20.474,0,28.284c3.906,3.906,9.023,5.858,14.143,5.858
                                            c5.118,0,10.237-1.953,14.143-5.858l79.196-79.196c3.75-3.75,5.857-8.838,5.857-14.142V96c0-11.046-8.954-20-20-20
                                            C244.954,76,236,84.954,236,96z" />
                                                <path d="M492,43c-11.046,0-20,8.954-20,20v55.536C425.448,45.528,344.151,0,256,0C187.62,0,123.333,26.629,74.98,74.98
                                            C26.629,123.333,0,187.62,0,256s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512c0.169,0,0.332-0.021,0.5-0.025
                                            c0.168,0.004,0.331,0.025,0.5,0.025c7.208,0,14.487-0.304,21.637-0.902c11.007-0.922,19.183-10.592,18.262-21.599
                                            c-0.923-11.007-10.58-19.187-21.6-18.261C269.255,471.743,263.099,472,257,472c-0.169,0-0.332,0.021-0.5,0.025
                                            c-0.168-0.004-0.331-0.025-0.5-0.025c-119.103,0-216-96.897-216-216S136.897,40,256,40c76.758,0,147.357,40.913,185.936,106
                                            h-54.993c-11.046,0-20,8.954-20,20s8.954,20,20,20H448c12.18,0,23.575-3.423,33.277-9.353c0.624-0.356,1.224-0.739,1.796-1.152
                                            C500.479,164.044,512,144.347,512,122V63C512,51.954,503.046,43,492,43z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="info__title theme-font-2 font-weight-bold fs-20 lh-28">Learn on your schedule
                            </h3>
                            <p class="info__text">Flexibility empowers your growth.
                            <p>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 responsive-column-half">
                        <div class="info-box info--box info--box-2 hover-s border-blue">
                            <div class="icon-element icon-element-md bg-4">
                                <svg class="svg-icon-color-white" viewBox="0 0 512 512" width="30"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m422.782 161.813h-37.23v-39.665c0-22.73-8.552-44.383-24.081-60.968-2.887-3.084-7.727-3.242-10.809-.355-3.083 2.887-3.242 7.726-.355 10.808 12.865 13.741 19.951 31.681 19.951 50.515v39.665h-155.612c-49.195 0-89.218 40.024-89.218 89.219v27.358h-11.978c-4.765 0-9.246 1.856-12.617 5.226l-40.588 40.588v-40.83c0-6.255-3.349-12.133-8.742-15.339-22.334-13.279-36.209-37.637-36.209-63.568v-82.319c0-40.762 33.162-73.924 73.924-73.924h207.116c9.554 0 18.847 1.793 27.621 5.331 3.917 1.577 8.373-.317 9.952-4.233 1.579-3.917-.316-8.373-4.233-9.952-10.599-4.274-21.817-6.44-33.34-6.44h-207.116c-49.195 0-89.218 40.023-89.218 89.218v82.319c0 31.298 16.74 60.693 43.687 76.714.78.464 1.264 1.304 1.264 2.194v44.522c0 5.587 3.335 10.578 8.497 12.717 3.445 1.656 10.479 1.417 15.001-2.983l43.198-43.199c.482-.482 1.122-.747 1.803-.747h11.978v39.665c0 12.042 2.36 23.727 7.014 34.731 1.645 3.889 6.132 5.706 10.022 4.064 3.89-1.645 5.709-6.132 4.065-10.022-3.852-9.108-5.806-18.788-5.806-28.772v-82.318c0-40.763 33.162-73.925 73.924-73.925h208.135c40.762 0 73.924 33.162 73.924 73.925v82.318c0 26.032-13.311 49.66-35.608 63.206-5.255 3.193-8.52 9.02-8.52 15.206v49.876l-49.138-49.139c-3.37-3.37-7.851-5.226-12.617-5.226h-176.177c-18.551 0-36.29-6.9-49.951-19.428-3.112-2.853-7.949-2.645-10.805.467-2.855 3.113-2.646 7.95.467 10.805 16.489 15.123 37.899 23.451 60.288 23.451h176.176c.671 0 1.328.272 1.802.747l51.749 51.749c3.996 3.071 7.902 5.445 15 2.983 5.162-2.139 8.497-7.13 8.497-12.717v-53.569c0-.879.448-1.698 1.168-2.135 26.903-16.343 42.963-44.857 42.963-76.277v-82.318c0-49.195-40.023-89.219-89.218-89.219z" />
                                        <path
                                            d="m297.13 344.186c-4.484-6.336-12.653-10.584-21.97-10.584-14.127 0-25.619 9.765-25.619 21.768 0 12.002 11.493 21.767 25.619 21.767 12.396 0 22.761-7.519 25.116-17.471 11.28-4.751 20.16-14.218 24.014-26.195 11.168-2.543 19.531-12.547 19.531-24.475v-27.575c0-11.515-7.794-21.237-18.382-24.185-2.492-15.359-10.04-29.452-21.611-40.103-12.911-11.885-29.691-18.43-47.249-18.43-34.551 0-63.45 24.887-68.867 58.534-10.584 2.95-18.375 12.671-18.375 24.183v27.575c0 13.844 11.263 25.107 25.107 25.107s25.107-11.263 25.107-25.107v-27.575c0-10.795-6.849-20.02-16.429-23.56 4.958-25.335 27.105-43.863 53.457-43.863 26.018 0 48.444 18.852 53.437 43.871-9.57 3.545-16.409 12.764-16.409 23.552v27.575c0 10.204 6.122 19 14.884 22.923-2.431 5.224-6.43 9.491-11.361 12.268zm-21.97 17.658c-6.085 0-10.325-3.411-10.325-6.473s4.24-6.474 10.325-6.474 10.326 3.412 10.326 6.474-4.242 6.473-10.326 6.473zm-70.903-52.847c0 5.411-4.402 9.813-9.813 9.813s-9.813-4.402-9.813-9.813v-27.575c0-5.411 4.402-9.813 9.813-9.813s9.813 4.402 9.813 9.813zm104.644-27.575c0-5.411 4.402-9.813 9.813-9.813s9.813 4.402 9.813 9.813v27.575c0 5.411-4.402 9.813-9.813 9.813s-9.813-4.402-9.813-9.813z" />
                                        <path
                                            d="m363.692 242.043h60.911c4.223 0 7.647-3.423 7.647-7.647s-3.424-7.647-7.647-7.647h-60.911c-4.223 0-7.647 3.423-7.647 7.647s3.424 7.647 7.647 7.647z" />
                                        <path
                                            d="m363.692 276.276h46.967c4.223 0 7.647-3.423 7.647-7.647s-3.424-7.647-7.647-7.647h-46.967c-4.223 0-7.647 3.423-7.647 7.647s3.424 7.647 7.647 7.647z" />
                                        <circle cx="75.233" cy="132.953" r="11.401" />
                                        <circle cx="109.763" cy="132.953" r="11.401" />
                                        <circle cx="144.09" cy="132.953" r="11.401" />
                                    </g>
                                </svg>
                            </div>
                            <h3 class="info__title theme-font-2 font-weight-bold fs-20 lh-28">The help you need, when
                                you need it</h3>
                            <p class="info__text">Support available at every step.
                            <p>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end benefit-area -->
    <!--======================================
        END BENEFIT AREA
======================================-->

    <!-- ================================
       START FUNFACT AREA
================================= -->
    <section class="overflow-hidden text-center funfact-area pb-80px dot-bg">
        <div class="container">
            <div class="text-center section-heading">
                <h2 class="section__title theme-font-2">Strength in numbers</h2>
            </div><!-- end section-heading -->
            <div class="row pt-50px">
                <div class="col-lg-4 responsive-column-half">
                    <div class="counter-item">
                        <div class="mb-4 shadow-sm counter__icon icon-element">
                            <svg class="svg-icon-color-1" width="40" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m499.5 422h-10v-304.92c0-20.678-16.822-37.5-37.5-37.5h-108.332v-27.962c0-28.462-23.156-51.618-51.618-51.618h-72.1c-28.462 0-51.618 23.156-51.618 51.618v27.962h-108.332c-20.678 0-37.5 16.822-37.5 37.5v304.92h-10c-6.893 0-12.5 5.607-12.5 12.5v34.549c0 23.683 19.268 42.951 42.951 42.951h426.098c23.683 0 42.951-19.268 42.951-42.951v-34.549c0-6.893-5.607-12.5-12.5-12.5zm-155.832-307.112h2.347c6.299 0 11.423 5.124 11.423 11.423 0 6.298-5.124 11.422-11.423 11.422h-2.347zm0 37.844h2.347c15.203.011 27.366-12.987 26.36-28.152h72.125v249.151h-18.64v-41.301c0-14.129-4.877-27.975-13.732-38.988-8.856-11.014-21.335-18.751-35.139-21.786l-67.199-14.761c-4.975-1.086-8.438-5.551-8.44-10.494v-12.896c25.347-15.384 42.318-43.248 42.318-75.002zm-144.678 120.228 6.441-1.415c6.113-1.344 11.335-4.877 14.948-9.642l24.143 17.74-15.434 15.434zm29.701 38.208-3.889 62.563h-123.662v-41.301c0-22 15.599-41.398 37.09-46.124l41.257-9.062 43.142 31.702c1.838 1.349 3.941 2.081 6.062 2.222zm57.691-64.029-30.382 22.325-30.382-22.325c.031-.624.058-5.717.033-6.388 9.461 3.502 19.686 5.419 30.35 5.419s20.888-1.917 30.35-5.419c-.013.671-.005 5.765.031 6.388zm-42.032 53.89 11.65-11.65 11.599 11.599 4.258 72.753h-32.027zm23.129-21.385 24.143-17.74c3.613 4.765 8.835 8.298 14.948 9.642l6.44 1.415-30.098 22.118zm21.894 29.3 43.14-31.701 41.256 9.062c21.492 4.726 37.091 24.124 37.091 46.124v41.302h-123.976l-3.662-62.561c2.151-.126 4.287-.857 6.151-2.226zm-106.041-194.309c10.817-.592 21.509-2.153 31.874-4.66 4.026-.974 6.501-5.027 5.527-9.054-.975-4.026-5.026-6.503-9.054-5.526-9.216 2.229-18.722 3.628-28.348 4.202v-47.979c.001-20.191 16.428-36.618 36.619-36.618h72.1c20.191 0 36.618 16.427 36.618 36.618v45.1c-6.201-2.706-12.011-6.201-17.336-10.485-7.358-5.922-13.503-13.088-18.26-21.298-1.673-2.89-4.521-4.86-7.814-5.407-3.288-.544-6.619.398-9.132 2.589-10.05 8.761-21.15 16.144-33.04 21.971-3.719 1.822-5.257 6.315-3.434 10.035 1.821 3.718 6.313 5.258 10.035 3.434 11.728-5.747 22.683-12.825 32.811-21.178 5.302 8.187 11.822 15.419 19.43 21.54 8.063 6.488 17.038 11.5 26.74 14.939v45.645c0 40.069-32.599 72.668-72.668 72.668s-72.668-32.599-72.668-72.668zm27.318 118.869v12.896c-.006 4.93-3.494 9.415-8.439 10.494l-67.201 14.761c-13.803 3.035-26.281 10.772-35.138 21.786-8.855 11.014-13.732 24.859-13.732 38.988v41.302h-18.64v-249.151h72.125c-1.022 15.115 11.132 28.186 26.36 28.152h2.347v5.77c0 31.754 16.971 59.619 42.318 75.002zm-56.087-107.193c0-6.299 5.124-11.423 11.423-11.423h2.347v22.845h-2.347c-6.299-.001-11.423-5.125-11.423-11.422zm342.437 342.738c0 15.412-12.539 27.951-27.951 27.951h-426.098c-15.412 0-27.951-12.539-27.951-27.951v-32.049h190.545v12.5c0 9.649 7.851 17.5 17.5 17.5h65.91c9.649 0 17.5-7.851 17.5-17.5v-12.5h72.043c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-340.998v-304.92c0-12.406 10.094-22.5 22.5-22.5h108.332v5.308h-2.347c-8.226 0-15.584 3.78-20.434 9.692h-81.551c-6.341 0-11.5 5.159-11.5 11.5v260.151c0 4.143 3.357 7.5 7.5 7.5h392c4.143 0 7.5-3.357 7.5-7.5v-260.151c0-6.341-5.159-11.5-11.5-11.5h-81.551c-4.85-5.913-12.208-9.692-20.434-9.692h-2.347v-5.308h108.332c12.406 0 22.5 10.094 22.5 22.5v304.92h-61.002c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h83.502zm-276.455-19.549v-12.5h70.91v12.5c0 1.379-1.121 2.5-2.5 2.5h-65.91c-1.379 0-2.5-1.121-2.5-2.5zm16.377-243.596c5.712 3.132 12.166 4.823 18.662 4.892 8.306.087 15.383-2.637 19.495-4.893 3.632-1.992 4.96-6.551 2.968-10.183s-6.549-4.961-10.183-2.968c-2.545 1.396-6.654 3.045-11.863 3.045-5.146 0-9.343-1.661-11.866-3.046-3.633-1.994-8.191-.661-10.183 2.97-1.991 3.633-.662 8.191 2.97 10.183zm-19.602-52.241c4.143 0 7.5-3.357 7.5-7.5v-15.472c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v15.472c0 4.143 3.358 7.5 7.5 7.5zm77.36 0c4.143 0 7.5-3.357 7.5-7.5v-15.472c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v15.472c0 4.143 3.357 7.5 7.5 7.5z" />
                                </g>
                            </svg>
                        </div>
                        <h4 class="mb-3 counter__title text-color-2 fs-30">100,000+</h4>
                        <p class="counter__meta">ITEE graduations and <br> counting</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="counter-item">
                        <div class="mb-4 shadow-sm counter__icon icon-element">
                            <svg class="svg-icon-color-2" width="42" version="1.1"
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
                        <h4 class="mb-3 counter__title text-color-3 fs-30">220+</h4>
                        <p class="counter__meta">Support available <br> at every step</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="counter-item">
                        <div class="mb-4 shadow-sm counter__icon icon-element">
                            <svg class="svg-icon-color-3" width="42" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480.1 480.1"
                                xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M240.135,0.05C144.085,0.036,57.277,57.289,19.472,145.586l-2.992,0.992l1.16,3.48
                                    c-49.776,122.766,9.393,262.639,132.159,312.415c28.673,11.626,59.324,17.594,90.265,17.577
                                    c132.548,0.02,240.016-107.416,240.036-239.964S372.684,0.069,240.135,0.05z M428.388,361.054l-12.324-12.316V320.05
                                    c0.014-1.238-0.26-2.462-0.8-3.576l-31.2-62.312V224.05c0-2.674-1.335-5.172-3.56-6.656l-24-16
                                    c-1.881-1.256-4.206-1.657-6.4-1.104l-29.392,7.344l-49.368-21.184l-6.792-47.584l18.824-18.816h40.408l13.6,20.44
                                    c1.228,1.838,3.163,3.087,5.344,3.448l48,8c1.286,0.216,2.604,0.111,3.84-0.304l44.208-14.736
                                    C475.855,208.053,471.889,293.634,428.388,361.054z M395.392,78.882l-13.008,8.672l-36.264-7.256l-23.528-7.832
                                    c-1.44-0.489-2.99-0.551-4.464-0.176l-29.744,7.432l-13.04-4.344l9.664-19.328h27.056c1.241,0.001,2.465-0.286,3.576-0.84
                                    l27.68-13.84C362.382,51.32,379.918,63.952,395.392,78.882z M152.44,33.914l19.2,12.8c0.944,0.628,2.01,1.048,3.128,1.232
                                    l38.768,6.464l-3.784,11.32l-20.2,6.744c-1.809,0.602-3.344,1.83-4.328,3.464l-22.976,38.288l-36.904,22.144l-54.4,7.768
                                    c-3.943,0.557-6.875,3.93-6.88,7.912v24c0,2.122,0.844,4.156,2.344,5.656l13.656,13.656v13.744l-33.28-22.192l-12.072-36.216
                                    C57.68,98.218,99.777,56.458,152.44,33.914z M129.664,296.21l-36.16-7.24l-13.44-26.808v-18.8l29.808-29.808l11.032,22.072
                                    c1.355,2.712,4.128,4.425,7.16,4.424h51.472l21.672,36.12c1.446,2.407,4.048,3.879,6.856,3.88h22.24l-5.6,28.056l-30.288,30.288
                                    c-1.503,1.499-2.349,3.533-2.352,5.656v20l-28.8,21.6c-2.014,1.511-3.2,3.882-3.2,6.4v28.896l-9.952-3.296l-14.048-35.136V304.05
                                    C136.065,300.248,133.389,296.97,129.664,296.21z M105.616,419.191C30.187,362.602-1.712,264.826,25.832,174.642l6.648,19.936
                                    c0.56,1.687,1.666,3.14,3.144,4.128l39.88,26.584l-9.096,9.104c-1.5,1.5-2.344,3.534-2.344,5.656v24
                                    c-0.001,1.241,0.286,2.465,0.84,3.576l16,32c1.108,2.21,3.175,3.784,5.6,4.264l33.6,6.712v73.448
                                    c-0.001,1.016,0.192,2.024,0.568,2.968l16,40c0.876,2.185,2.67,3.874,4.904,4.616l24,8c0.802,0.272,1.642,0.412,2.488,0.416
                                    c4.418,0,8-3.582,8-8v-36l28.8-21.6c2.014-1.511,3.2-3.882,3.2-6.4v-20.688l29.656-29.656c1.115-1.117,1.875-2.54,2.184-4.088
                                    l8-40c0.866-4.333-1.944-8.547-6.277-9.413c-0.515-0.103-1.038-0.155-1.563-0.155h-27.472l-21.672-36.12
                                    c-1.446-2.407-4.048-3.879-6.856-3.88h-51.056l-13.744-27.576c-1.151-2.302-3.339-3.91-5.88-4.32
                                    c-2.54-0.439-5.133,0.399-6.936,2.24l-10.384,10.344V192.05c0-2.122-0.844-4.156-2.344-5.656l-13.656-13.656v-13.752l49.136-7.016
                                    c1.055-0.153,2.07-0.515,2.984-1.064l40-24c1.122-0.674,2.062-1.614,2.736-2.736l22.48-37.464l21.192-7.072
                                    c2.393-0.785,4.271-2.662,5.056-5.056l8-24c1.386-4.195-0.891-8.72-5.086-10.106c-0.387-0.128-0.784-0.226-1.186-0.294
                                    l-46.304-7.72l-8.136-5.424c50.343-16.386,104.869-14.358,153.856,5.72l-14.616,7.296h-30.112c-3.047-0.017-5.838,1.699-7.2,4.424
                                    l-16,32c-1.971,3.954-0.364,8.758,3.59,10.729c0.337,0.168,0.685,0.312,1.042,0.431l24,8c1.44,0.489,2.99,0.551,4.464,0.176
                                    l29.744-7.432l21.792,7.256c0.312,0.112,0.633,0.198,0.96,0.256l40,8c2.08,0.424,4.244-0.002,6.008-1.184l18.208-12.144
                                    c8.961,9.981,17.014,20.741,24.064,32.152l-39.36,13.12l-42.616-7.104l-14.08-21.12c-1.476-2.213-3.956-3.547-6.616-3.56h-48
                                    c-2.122,0-4.156,0.844-5.656,2.344l-24,24c-1.782,1.781-2.621,4.298-2.264,6.792l8,56c0.403,2.769,2.223,5.126,4.8,6.216l56,24
                                    c1.604,0.695,3.394,0.838,5.088,0.408l28.568-7.144l17.464,11.664v27.72c-0.014,1.238,0.26,2.462,0.8,3.576l31.2,62.312v30.112
                                    c0,2.122,0.844,4.156,2.344,5.656l16.736,16.744C344.921,473.383,204.549,493.415,105.616,419.191z" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h4 class="mb-3 counter__title text-color-4 fs-30">120+</h4>
                        <p class="counter__meta">Technical partners <br> supporting globally</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-4 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end funfact-area -->
    <!-- ================================
       START FUNFACT AREA
================================= -->

    <!--======================================
        START CTA AREA
======================================-->
    <section class="cat-area pt-80px pb-80px bg-radial-gradient-gray">
        <div class="container">
            <div class="text-center cta-content-wrap">
                <div class="section-heading">
                    <h2 class="pb-4 section__title fs-45 lh-55 theme-font-2">Make the most of your online <br>
                        learning experience</h2>
                    <p class="section__desc">Our Online Learning Resource Center has tips, tricks and inspiring
                        stories
                        <br> to help you learn while staying home.
                    </p>
                </div><!-- end section-heading -->
                <div class="cat-btn-box mt-28px">
                    <a href="https://lightboat.lightworks.co.jp/en-promotion" class="btn theme-btn">Explore Resources
                        <i class="ml-1 la la-arrow-right icon"></i></a>
                </div><!-- end cat-btn-box -->
            </div><!-- end cta-content-wrap -->
        </div><!-- end container -->
    </section><!-- end cta-area -->
    <!--======================================
        END CTA AREA
======================================-->
    <div class="section-block"></div>

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
                <h2 class="pb-4 section__title theme-font-2">In association with</h2>
            </div><!-- end section-heading -->
            <div class="pt-4 client-logo-carousel">
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
            </div><!-- end client-logo-carousel -->
        </div><!-- end container -->
    </section><!-- end client-logo-area -->
    <!-- ================================
       START CLIENT-LOGO AREA
================================= -->

    <!--======================================
        START SUBSCRIBER AREA
======================================-->
    <section class="cat-area pt-80px pb-80px bg-radial-gradient-gray">
        <div class="container">
            <div class="text-center cta-content-wrap">
                <div class="section-heading">
                    <h2 class="pb-4 section__title lh-50 theme-font-2">Discover a faster way to <br> learn and grow
                        personally</h2>
                </div><!-- end section-heading -->
            </div><!-- end cta-content-wrap -->
        </div><!-- end container -->
    </section><!-- end cat-area -->
    <!--======================================
        END SUBSCRIBER AREA
======================================-->

    <!-- ================================
         END FOOTER AREA
================================= -->
    <section class="footer-area pt-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="fs-20 font-weight-semi-bold">Contact</h3>
                        <ul class="py-4 generic-list-item">
                            <li><a href="tel:+880255006847">+8802 55006847</a></li>
                            <li><a href="tel:+8801857321122">+88018 57321122</a></li>
                            <li><a href="mailto:info@bditec.gov.bd">info@bditec.gov.bd</a></li>
                            <li>Bangladesh Computer Council (BCC) <br /> ICT Tower (BCC Bhaban) <br /> Agargaon,
                                Sher-e-Bangla
                                Nagar <br /> Dhaka-1207</li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="fs-20 font-weight-semi-bold">Company</h3>
                        <ul class="pt-4 generic-list-item">
                            <li><a href="https://lightboat.lightworks.co.jp/en-promotion">Become a Learner</a></li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="fs-20 font-weight-semi-bold">Links</h3>
                        <ul class="pt-4 generic-list-item">
                            <li><a href="https://ictd.gov.bd/">ICTD</a></li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 responsive-column-half">
                    <div class="footer-item">
                        <h3 class="fs-20 font-weight-semi-bold">Support</h3>
                        <ul class="pt-4 generic-list-item">
                            <li><a href="https://bditec.gov.bd/">BDITEC</a></li>
                        </ul>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="section-block"></div>
        <div class="py-4 copyright-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <p class="copy-desc">&copy; 2024 BCC. All Rights Reserved by <a
                                href="https://bcc.gov.bd/">Bangladesh Computer Council</a></p>
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
