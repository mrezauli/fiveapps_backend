<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Aduca - Education HTML Template</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('aduca/images/favicon.png') }}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/emojionearea.css') }}">
    <link rel="stylesheet" href="{{ asset('aduca/css/jquery-te-1.4.0.css') }}">
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
                                <a href="index.html" class="logo"><img src="{{ asset('aduca/images/logo.png') }}"
                                        alt="logo"></a>
                                <div class="user-btn-action">
                                    <div class="mr-2 shadow-sm search-menu-toggle icon-element icon-element-sm"
                                        data-toggle="tooltip" data-placement="top" title="Search">
                                        <i class="la la-search"></i>
                                    </div>
                                    <div class="mr-2 shadow-sm off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm"
                                        data-toggle="tooltip" data-placement="top" title="Category menu">
                                        <i class="la la-th-large"></i>
                                    </div>
                                    <div class="shadow-sm off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm"
                                        data-toggle="tooltip" data-placement="top" title="Main menu">
                                        <i class="la la-bars"></i>
                                    </div>
                                </div>
                            </div><!-- end logo-box -->
                            <div class="menu-wrapper">
                                <form method="post" class="ml-0 mr-auto">
                                    <div class="mb-0 form-group">
                                        <input class="pl-3 form-control form--control form--control-gray" type="text"
                                            name="search" placeholder="Search for anything">
                                        <span class="la la-search search-icon"></span>
                                    </div>
                                </form>
                                <div class="nav-right-button d-flex align-items-center">
                                    <div class="user-action-wrap d-flex align-items-center">
                                        <div class="pr-3 mr-3 shop-cart course-cart border-right border-right-gray">
                                            <ul>
                                                <li>
                                                    <p class="shop-cart-btn d-flex align-items-center fs-16">
                                                        My Courses
                                                        <span class="ml-1 la la-angle-down fs-13"></span>
                                                    </p>
                                                    <ul class="cart-dropdown-menu after-none">
                                                        <li class="media media-card">
                                                            <a href="lesson-details.html" class="media-img">
                                                                <img class="mr-3"
                                                                    src="{{ asset('aduca/images/small-img-3.jpg') }}"
                                                                    alt="Course thumbnail image">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5><a href="lesson-details.html">The Complete
                                                                        JavaScript Course 2021: From Zero to Expert!</a>
                                                                </h5>
                                                                <div class="pt-3 skillbar-box">
                                                                    <div class="skillbar skillbar-skillbar"
                                                                        data-percent="36%">
                                                                        <div class="skillbar-bar skillbar--bar bg-1">
                                                                        </div>
                                                                    </div><!-- End Skill Bar -->
                                                                </div><!-- End skillbar-box -->
                                                            </div>
                                                        </li>
                                                        <li class="media media-card">
                                                            <a href="lesson-details.html" class="media-img">
                                                                <img class="mr-3"
                                                                    src="{{ asset('aduca/images/small-img-4.jpg') }}"
                                                                    alt="Course thumbnail image">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5><a href="lesson-details.html">The Complete
                                                                        JavaScript Course 2021: From Zero to Expert!</a>
                                                                </h5>
                                                                <div class="pt-3 skillbar-box">
                                                                    <div class="skillbar skillbar-skillbar"
                                                                        data-percent="77%">
                                                                        <div class="skillbar-bar skillbar--bar bg-1">
                                                                        </div>
                                                                    </div><!-- End Skill Bar -->
                                                                </div><!-- End skillbar-box -->
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="my-courses.html" class="btn theme-btn w-100">Got
                                                                to my course <i
                                                                    class="ml-1 la la-arrow-right icon"></i></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div><!-- end course-cart -->
                                        <div class="pr-3 mr-3 shop-cart border-right border-right-gray">
                                            <ul>
                                                <li>
                                                    <p class="shop-cart-btn d-flex align-items-center">
                                                        <i class="la la-shopping-cart fs-22"></i>
                                                        <span class="dot-status bg-1"></span>
                                                    </p>
                                                    <ul class="cart-dropdown-menu after-none">
                                                        <li class="media media-card">
                                                            <a href="shopping-cart.html" class="media-img">
                                                                <img class="mr-3"
                                                                    src="{{ asset('aduca/images/small-img.jpg') }}"
                                                                    alt="Cart image">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5><a href="shopping-cart.html">The Complete
                                                                        JavaScript Course 2021: From Zero to Expert!</a>
                                                                </h5>
                                                                <span class="py-1 d-block lh-18">Kamran Ahmed</span>
                                                                <p class="text-black font-weight-semi-bold lh-18">
                                                                    $12.99 <span
                                                                        class="before-price fs-14">$129.99</span></p>
                                                            </div>
                                                        </li>
                                                        <li class="media media-card">
                                                            <a href="shopping-cart.html" class="media-img">
                                                                <img class="mr-3"
                                                                    src="{{ asset('aduca/images/small-img.jpg') }}"
                                                                    alt="Cart image">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5><a href="shopping-cart.html">The Complete
                                                                        JavaScript Course 2021: From Zero to Expert!</a>
                                                                </h5>
                                                                <span class="py-1 d-block lh-18">Kamran Ahmed</span>
                                                                <p class="text-black font-weight-semi-bold lh-18">
                                                                    $12.99 <span
                                                                        class="before-price fs-14">$129.99</span></p>
                                                            </div>
                                                        </li>
                                                        <li class="media media-card">
                                                            <div class="media-body fs-16">
                                                                <p class="text-black font-weight-semi-bold lh-18">
                                                                    Total: <span class="cart-total">$12.99</span> <span
                                                                        class="before-price fs-14">$129.99</span></p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="shopping-cart.html"
                                                                class="btn theme-btn w-100">Got to cart <i
                                                                    class="ml-1 la la-arrow-right icon"></i></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div><!-- end shop-cart -->
                                        <div class="pr-3 mr-3 shop-cart wishlist-cart border-right border-right-gray">
                                            <ul>
                                                <li>
                                                    <p class="shop-cart-btn">
                                                        <i class="la la-heart-o"></i>
                                                        <span class="dot-status bg-1"></span>
                                                    </p>
                                                    <ul class="cart-dropdown-menu after-none">
                                                        <li>
                                                            <div class="media media-card">
                                                                <a href="course-details.html" class="media-img">
                                                                    <img class="mr-3"
                                                                        src="{{ asset('aduca/images/small-img.jpg') }}"
                                                                        alt="Cart image">
                                                                </a>
                                                                <div class="media-body">
                                                                    <h5><a href="course-details.html">The Complete
                                                                            JavaScript Course 2021: From Zero to
                                                                            Expert!</a></h5>
                                                                    <span class="py-1 d-block lh-18">Kamran
                                                                        Ahmed</span>
                                                                    <p class="text-black font-weight-semi-bold lh-18">
                                                                        $12.99 <span
                                                                            class="before-price fs-14">$129.99</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <a href="#"
                                                                class="mt-3 btn theme-btn theme-btn-sm theme-btn-transparent lh-28 w-100">Add
                                                                to cart <i class="ml-1 la la-arrow-right icon"></i></a>
                                                        </li>
                                                        <li>
                                                            <div class="media media-card">
                                                                <a href="course-details.html" class="media-img">
                                                                    <img class="mr-3"
                                                                        src="{{ asset('aduca/images/small-img.jpg') }}"
                                                                        alt="Cart image">
                                                                </a>
                                                                <div class="media-body">
                                                                    <h5><a href="course-details.html">The Complete
                                                                            JavaScript Course 2021: From Zero to
                                                                            Expert!</a></h5>
                                                                    <span class="py-1 d-block lh-18">Kamran
                                                                        Ahmed</span>
                                                                    <p class="text-black font-weight-semi-bold lh-18">
                                                                        $12.99 <span
                                                                            class="before-price fs-14">$129.99</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <a href="#"
                                                                class="mt-3 btn theme-btn theme-btn-sm theme-btn-transparent lh-28 w-100">Add
                                                                to cart <i class="ml-1 la la-arrow-right icon"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="my-courses.html" class="btn theme-btn w-100">Got
                                                                to wishlist <i
                                                                    class="ml-1 la la-arrow-right icon"></i></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div><!-- end shop-cart -->
                                        <div
                                            class="pr-3 mr-3 shop-cart notification-cart border-right border-right-gray">
                                            <ul>
                                                <li>
                                                    <p class="shop-cart-btn">
                                                        <i class="la la-bell"></i>
                                                        <span class="dot-status bg-1"></span>
                                                    </p>
                                                    <ul
                                                        class="p-0 cart-dropdown-menu after-none notification-dropdown-menu">
                                                        <li
                                                            class="menu-heading-block d-flex align-items-center justify-content-between">
                                                            <h4>Notifications</h4>
                                                            <span class="ribbon fs-14">18</span>
                                                        </li>
                                                        <li>
                                                            <div class="notification-body">
                                                                <a href="dashboard.html"
                                                                    class="media media-card align-items-center">
                                                                    <div
                                                                        class="flex-shrink-0 mr-3 text-white icon-element icon-element-sm bg-1">
                                                                        <i class="la la-bolt"></i>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h5>Your resume updated!</h5>
                                                                        <span
                                                                            class="pt-1 d-block lh-18 text-gray fs-13">1
                                                                            hour ago</span>
                                                                    </div>
                                                                </a>
                                                                <a href="dashboard.html"
                                                                    class="media media-card align-items-center">
                                                                    <div
                                                                        class="flex-shrink-0 mr-3 text-white icon-element icon-element-sm bg-2">
                                                                        <i class="la la-lock"></i>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h5>You changed password</h5>
                                                                        <span
                                                                            class="pt-1 d-block lh-18 text-gray fs-13">November
                                                                            12, 2019</span>
                                                                    </div>
                                                                </a>
                                                                <a href="dashboard.html"
                                                                    class="media media-card align-items-center">
                                                                    <div
                                                                        class="flex-shrink-0 mr-3 text-white icon-element icon-element-sm bg-3">
                                                                        <i class="la la-user"></i>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h5>Your account has been created successfully
                                                                        </h5>
                                                                        <span
                                                                            class="pt-1 d-block lh-18 text-gray fs-13">November
                                                                            12, 2019</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li class="menu-heading-block">
                                                            <a href="dashboard.html" class="btn theme-btn w-100">Show
                                                                All Notifications <i
                                                                    class="ml-1 la la-arrow-right icon"></i></a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div><!-- end shop-cart -->
                                        <div class="shop-cart user-profile-cart">
                                            <ul>
                                                <li>
                                                    <div class="shop-cart-btn">
                                                        <div class="avatar-xs">
                                                            <img class="rounded-full img-fluid"
                                                                src="{{ asset('aduca/images/small-avatar-1.jpg" alt="Avatar image') }}">
                                                        </div>
                                                        <span class="dot-status bg-1"></span>
                                                    </div>
                                                    <ul
                                                        class="p-0 cart-dropdown-menu after-none notification-dropdown-menu">
                                                        <li class="menu-heading-block d-flex align-items-center">
                                                            <a href="teacher-detail.html"
                                                                class="flex-shrink-0 avatar-sm d-block">
                                                                <img class="rounded-full img-fluid"
                                                                    src="{{ asset('aduca/images/small-avatar-1.jpg') }}"
                                                                    alt="Avatar image">
                                                            </a>
                                                            <div class="ml-2">
                                                                <h4><a href="teacher-detail.html"
                                                                        class="text-black">Alex Smith</a></h4>
                                                                <span
                                                                    class="d-block fs-14 lh-20">alexsmith@example.com</span>
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
                                                                    <a href="my-courses.html">
                                                                        <i class="mr-1 la la-file-video-o"></i> My
                                                                        courses
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="shopping-cart.html">
                                                                        <i class="mr-1 la la-shopping-basket"></i> My
                                                                        cart
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="my-courses.html">
                                                                        <i class="mr-1 la la-heart-o"></i> My wishlist
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="section-block"></div>
                                                                </li>
                                                                <li>
                                                                    <a href="dashboard.html">
                                                                        <i class="mr-1 la la-bell"></i> Notifications
                                                                        <span
                                                                            class="p-1 ml-2 text-white badge bg-info">9+</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="dashboard-message.html">
                                                                        <i class="mr-1 la la-envelope"></i> Messages
                                                                        <span
                                                                            class="p-1 ml-2 text-white badge bg-info">12+</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="section-block"></div>
                                                                </li>
                                                                <li>
                                                                    <a href="dashboard-settings.html">
                                                                        <i class="mr-1 la la-gear"></i> Settings
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="dashboard-purchase-history.html">
                                                                        <i class="mr-1 la la-history"></i> Purchase
                                                                        history
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="section-block"></div>
                                                                </li>
                                                                <li>
                                                                    <a href="student-detail.html">
                                                                        <i class="mr-1 la la-user"></i> Public profile
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="dashboard-settings.html">
                                                                        <i class="mr-1 la la-edit"></i> Edit profile
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="section-block"></div>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <i class="mr-1 la la-question"></i> Help
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="index.html">
                                                                        <i class="mr-1 la la-power-off"></i> Logout
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <div class="section-block"></div>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="position-relative">
                                                                        <span
                                                                            class="fs-17 font-weight-semi-bold d-block">Aduca
                                                                            for Business</span>
                                                                        <span
                                                                            class="lh-20 d-block fs-14 text-gray">Bring
                                                                            learning to your company</span>
                                                                        <span
                                                                            class="top-0 right-0 mt-3 mr-3 position-absolute fs-18 text-gray">
                                                                            <i class="la la-external-link"></i>
                                                                        </span>
                                                                    </a>
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
            <h4 class="off-canvas-menu-heading pt-90px">Alerts</h4>
            <ul class="pt-1 pb-2 generic-list-item off-canvas-menu-list border-bottom border-bottom-gray">
                <li><a href="dashboard.html">Notifications</a></li>
                <li><a href="dashboard-message.html">Messages</a></li>
                <li><a href="my-courses.html">Wishlist</a></li>
                <li><a href="shopping-cart.html">My cart</a></li>
            </ul>
            <h4 class="off-canvas-menu-heading pt-20px">Account</h4>
            <ul class="pt-1 pb-2 generic-list-item off-canvas-menu-list border-bottom border-bottom-gray">
                <li><a href="dashboard-settings.html">Account settings</a></li>
                <li><a href="dashboard-purchase-history.html">Purchase history</a></li>
            </ul>
            <h4 class="off-canvas-menu-heading pt-20px">Profile</h4>
            <ul class="pt-1 pb-2 generic-list-item off-canvas-menu-list border-bottom border-bottom-gray">
                <li><a href="student-detail.html">Public profile</a></li>
                <li><a href="dashboard-settings.html">Edit profile</a></li>
                <li><a href="index.html">Log out</a></li>
            </ul>
            <h4 class="off-canvas-menu-heading pt-20px">More from Aduca</h4>
            <ul class="pt-1 generic-list-item off-canvas-menu-list">
                <li><a href="for-business.html">Aduca for Business</a></li>
                <li><a href="#">Get the app</a></li>
                <li><a href="invite.html">Invite friends</a></li>
                <li><a href="contact.html">Help</a></li>
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
        <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
            <div class="shadow-sm off-canvas-menu-close cat-menu-close icon-element icon-element-sm"
                data-toggle="tooltip" data-placement="left" title="Close menu">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
            <h4 class="off-canvas-menu-heading pt-90px">Learn</h4>
            <ul class="pt-1 pb-2 generic-list-item off-canvas-menu-list border-bottom border-bottom-gray">
                <li><a href="my-courses.html">My learning</a></li>
            </ul>
            <h4 class="off-canvas-menu-heading pt-20px">Categories</h4>
            <ul class="pt-1 generic-list-item off-canvas-menu-list">
                <li>
                    <a href="course-grid.html">Development</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Development</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Mobile Apps</a></li>
                        <li><a href="#">Game Development</a></li>
                        <li><a href="#">Databases</a></li>
                        <li><a href="#">Programming Languages</a></li>
                        <li><a href="#">Software Testing</a></li>
                        <li><a href="#">Software Engineering</a></li>
                        <li><a href="#">E-Commerce</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">business</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Business</a></li>
                        <li><a href="#">Finance</a></li>
                        <li><a href="#">Entrepreneurship</a></li>
                        <li><a href="#">Strategy</a></li>
                        <li><a href="#">Real Estate</a></li>
                        <li><a href="#">Home Business</a></li>
                        <li><a href="#">Communications</a></li>
                        <li><a href="#">Industry</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">IT & Software</a>
                    <ul class="sub-menu">
                        <li><a href="#">All IT & Software</a></li>
                        <li><a href="#">IT Certification</a></li>
                        <li><a href="#">Hardware</a></li>
                        <li><a href="#">Network & Security</a></li>
                        <li><a href="#">Operating Systems</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">Finance & Accounting</a>
                    <ul class="sub-menu">
                        <li><a href="#"> All Finance & Accounting</a></li>
                        <li><a href="#">Accounting & Bookkeeping</a></li>
                        <li><a href="#">Cryptocurrency & Blockchain</a></li>
                        <li><a href="#">Economics</a></li>
                        <li><a href="#">Investing & Trading</a></li>
                        <li><a href="#">Other Finance & Economics</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">design</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Design Tools</a></li>
                        <li><a href="#">3D & Animation</a></li>
                        <li><a href="#">User Experience</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">Personal Development</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Personal Development</a></li>
                        <li><a href="#">Personal Transformation</a></li>
                        <li><a href="#">Productivity</a></li>
                        <li><a href="#">Leadership</a></li>
                        <li><a href="#">Personal Finance</a></li>
                        <li><a href="#">Career Development</a></li>
                        <li><a href="#">Parenting & Relationships</a></li>
                        <li><a href="#">Happiness</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">Marketing</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Marketing</a></li>
                        <li><a href="#">Digital Marketing</a></li>
                        <li><a href="#">Search Engine Optimization</a></li>
                        <li><a href="#">Social Media Marketing</a></li>
                        <li><a href="#">Branding</a></li>
                        <li><a href="#">Video & Mobile Marketing</a></li>
                        <li><a href="#">Affiliate Marketing</a></li>
                        <li><a href="#">Growth Hacking</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">Health & Fitness</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Health & Fitness</a></li>
                        <li><a href="#">Fitness</a></li>
                        <li><a href="#">Sports</a></li>
                        <li><a href="#">Dieting</a></li>
                        <li><a href="#">Self Defense</a></li>
                        <li><a href="#">Meditation</a></li>
                        <li><a href="#">Mental Health</a></li>
                        <li><a href="#">Yoga</a></li>
                        <li><a href="#">Dance</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
                <li>
                    <a href="course-grid.html">Photography</a>
                    <ul class="sub-menu">
                        <li><a href="#">All Photography</a></li>
                        <li><a href="#">Digital Photography</a></li>
                        <li><a href="#">Photography Fundamentals</a></li>
                        <li><a href="#">Commercial Photography</a></li>
                        <li><a href="#">Video Design</a></li>
                        <li><a href="#">Photography Tools</a></li>
                        <li><a href="#">Other</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- end off-canvas-menu -->
        <div class="mobile-search-form">
            <div class="d-flex align-items-center">
                <form method="post" class="mr-3 flex-grow-1">
                    <div class="mb-0 form-group">
                        <input class="pl-3 form-control form--control" type="text" name="search"
                            placeholder="Search for anything">
                        <span class="la la-search search-icon"></span>
                    </div>
                </form>
                <div class="shadow-sm search-bar-close icon-element icon-element-sm">
                    <i class="la la-times"></i>
                </div><!-- end off-canvas-menu-close -->
            </div>
        </div><!-- end mobile-search-form -->
        <div class="body-overlay"></div>
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
                <a href="index.html" class="logo"><img src="images/logo.png') }}" alt="logo"></a>
            </div>
            <ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
                <li><a href="dashboard.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px"
                            viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                        </svg> Dashboard</a></li>
                <li><a href="dashboard-profile.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z" />
                        </svg> My Profile</a></li>
                <li><a href="dashboard-courses.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z" />
                        </svg> My Courses</a></li>
                <li><a href="dashboard-quiz.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 24 24" height="18px" viewBox="0 0 24 24" width="18px">
                            <g>
                                <rect fill="none" height="24" width="24" />
                            </g>
                            <g>
                                <path
                                    d="M11,21h-1l1-7H7.5c-0.88,0-0.33-0.75-0.31-0.78C8.48,10.94,10.42,7.54,13.01,3h1l-1,7h3.51c0.4,0,0.62,0.19,0.4,0.66 C12.97,17.55,11,21,11,21z" />
                            </g>
                        </svg> Quiz Attempts</a></li>
                <li><a href="dashboard-bookmark.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" />
                        </svg> Bookmarks</a></li>
                <li><a href="dashboard-enrolled-courses.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" />
                        </svg> Enrolled Courses</a></li>
                <li><a href="dashboard-message.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z" />
                        </svg> Message <span class="p-1 ml-2 badge badge-info">2</span></a></li>
                <li><a href="dashboard-reviews.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z" />
                        </svg> Reviews</a></li>
                <li><a href="dashboard-earnings.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" />
                        </svg> Earnings</a></li>
                <li><a href="dashboard-withdraw.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M21 7.28V5c0-1.1-.9-2-2-2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-2.28c.59-.35 1-.98 1-1.72V9c0-.74-.41-1.37-1-1.72zM20 9v6h-7V9h7zM5 19V5h14v2h-6c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h6v2H5z" />
                            <circle cx="16" cy="12" r="1.5" />
                        </svg> Withdraw</a></li>
                <li><a href="dashboard-purchase-history.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M15.55 13c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                        </svg> Purchase History</a></li>
                <li class="page-active"><a href="dashboard-submit-course.html"><svg class="mr-2"
                            xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                        </svg> Submit Course</a></li>
                <li><a href="dashboard-settings.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                            height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M19.43 12.98c.04-.32.07-.64.07-.98 0-.34-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.09-.16-.26-.25-.44-.25-.06 0-.12.01-.17.03l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.06-.02-.12-.03-.18-.03-.17 0-.34.09-.43.25l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98 0 .33.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.09.16.26.25.44.25.06 0 .12-.01.17-.03l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.06.02.12.03.18.03.17 0 .34-.09.43-.25l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zm-1.98-1.71c.04.31.05.52.05.73 0 .21-.02.43-.05.73l-.14 1.13.89.7 1.08.84-.7 1.21-1.27-.51-1.04-.42-.9.68c-.43.32-.84.56-1.25.73l-1.06.43-.16 1.13-.2 1.35h-1.4l-.19-1.35-.16-1.13-1.06-.43c-.43-.18-.83-.41-1.23-.71l-.91-.7-1.06.43-1.27.51-.7-1.21 1.08-.84.89-.7-.14-1.13c-.03-.31-.05-.54-.05-.74s.02-.43.05-.73l.14-1.13-.89-.7-1.08-.84.7-1.21 1.27.51 1.04.42.9-.68c.43-.32.84-.56 1.25-.73l1.06-.43.16-1.13.2-1.35h1.39l.19 1.35.16 1.13 1.06.43c.43.18.83.41 1.23.71l.91.7 1.06-.43 1.27-.51.7 1.21-1.07.85-.89.7.14 1.13zM12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                        </svg> Settings</a></li>
                <li><a href="index.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px"
                            viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M13 3h-2v10h2V3zm4.83 2.17l-1.42 1.42C17.99 7.86 19 9.81 19 12c0 3.87-3.13 7-7 7s-7-3.13-7-7c0-2.19 1.01-4.14 2.58-5.42L6.17 5.17C4.23 6.82 3 9.26 3 12c0 4.97 4.03 9 9 9s9-4.03 9-9c0-2.74-1.23-5.18-3.17-6.83z" />
                        </svg> Logout</a></li>
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#deleteModal"><svg class="mr-2"
                            xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z" />
                        </svg> Delete Account</a></li>
            </ul>
        </div><!-- end off-canvas-menu -->
        <div class="dashboard-content-wrap">
            <div class="mb-4 ml-3 dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent">
                <i class="mr-1 la la-bars"></i> Dashboard Nav
            </div>
            <div class="container-fluid">
                <div class="flex-wrap mb-5 breadcrumb-content d-flex align-items-center justify-content-between">
                    <div class="media media-card align-items-center">
                        <div class="rounded-full media-img media--img media-img-md">
                            <img class="rounded-full" src="{{ asset('aduca/images/small-avatar-1.jpg') }}"
                                alt="Student thumbnail image">
                        </div>
                        <div class="media-body">
                            <h2 class="section__title fs-30">Howdy, Tim Buchalka</h2>
                            <div class="pt-2 rating-wrap d-flex align-items-center">
                                <div class="review-stars">
                                    <span class="rating-number">4.4</span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star"></span>
                                    <span class="la la-star-o"></span>
                                </div>
                                <span class="pl-1 rating-total">(20,230)</span>
                            </div><!-- end rating-wrap -->
                        </div><!-- end media-body -->
                    </div><!-- end media -->
                    <div class="file-upload-wrap file-upload-wrap-2 file--upload-wrap">
                        <input type="file" name="files[]" class="multi file-upload-input">
                        <span class="file-upload-text"><i class="mr-2 la la-upload"></i>Upload a course</span>
                    </div><!-- file-upload-wrap -->
                </div><!-- end breadcrumb-content -->
                <div class="mb-5 section-block"></div>
                <div class="mb-5 dashboard-heading">
                    <h3 class="fs-22 font-weight-semi-bold">Submit Course</h3>
                </div>
                <form action="#">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 fs-22 font-weight-semi-bold">Basic info</h3>
                            <div class="divider"><span></span></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <div class="w-auto select-container">
                                                    <label for="itee_venue_id" class="label-text">Select a
                                                        Venue</label>
                                                    <select id="itee_venue_id" name="itee_venue_id"
                                                        class="select-container-select" required>
                                                        <option value="">Select Venue</option>
                                                        @foreach ($venues as $venue)
                                                            <option value="{{ $venue->id }}">{{ $venue->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <div class="w-auto select-container">
                                                    <!-- Hidden Input Field to Hold the Value -->
                                                    <input type="hidden" id="itee_exam_category_id"
                                                        name="itee_exam_category_id"
                                                        value="{{ $examFee->exam_category->id }}">
                                                    <label for="itee_exam_category_id_display"
                                                        class="label-text">Select a
                                                        Exam Category</label>
                                                    <select id="itee_exam_category_id_display"
                                                        name="itee_exam_category_id_display"
                                                        class="select-container-select" disabled>
                                                        <option value="">Select Exam Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $examFee->exam_category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <div class="w-auto select-container">
                                                    <input type="hidden" id="itee_exam_type_id"
                                                        name="itee_exam_type_id"
                                                        value="{{ $examFee->exam_type->id }}">
                                                    <label for="itee_exam_type_id_display" class="label-text">Select a
                                                        Exam Type</label>
                                                    <select id="itee_exam_type_id_display"
                                                        name="itee_exam_type_id_display"
                                                        class="select-container-select" disabled>
                                                        <option value="">Select Exam Type</option>
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}"
                                                                {{ $type->id == $examFee->exam_type->id ? 'selected' : '' }}>
                                                                {{ $type->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-12 -->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="w-auto select-container">
                                                    <input type="hidden" id="itee_exam_fees_id"
                                                        name="itee_exam_fees_id" value="{{ $examFee->id }}">
                                                    <label for="exam_fees_id_display" class="label-text">Select a
                                                        Exam Fee</label>
                                                    <select id="exam_fees_id_display" name="exam_fees_id_display"
                                                        class="select-container-select" disabled>
                                                        <option value="">Select Exam Fee</option>
                                                        @foreach ($fees as $fee)
                                                            <option value="{{ $fee->id }}"
                                                                {{ $fee->id == $examFee->id ? 'selected' : '' }}>
                                                                {{ $fee->name }} (BDT(৳) {{ $fee->fee }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="w-auto select-container">
                                                    <label for="itee_book_id" class="label-text">Select
                                                        Exam Book</label>
                                                    <select id="itee_book_id" name="itee_book_id"
                                                        class="select-container-select" required multiple>
                                                        @foreach ($books as $book)
                                                            <option value="{{ $book->id }}">
                                                                {{ $book->book_name }} (BDT(৳)
                                                                {{ $book->book_price }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-12 -->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 fs-22 font-weight-semi-bold">Video</h3>
                            <div class="divider"><span></span></div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="label-text">Video Title</label>
                                        <input class="pl-3 form-control form--control" type="text" name="text"
                                            placeholder="Video title">
                                    </div>
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="label-text">Video Category</label>
                                        <input class="pl-3 form-control form--control" type="text" name="text"
                                            placeholder="Video category">
                                    </div>
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="label-text">Video URL</label>
                                        <input class="pl-3 form-control form--control" type="text" name="text"
                                            placeholder="Video URL">
                                    </div>
                                </div><!-- end col-lg-4 -->
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                    <div class="pb-4 course-submit-btn-box">
                        <button class="btn theme-btn" type="submit">Submit Course</button>
                    </div>
                </form>
                <div class="pb-4 row align-items-center dashboard-copyright-content">
                    <div class="col-lg-6">
                        <p class="copy-desc">&copy; 2021 Aduca. All Rights Reserved. by <a
                                href="https://techydevs.com/">TechyDevs</a></p>
                    </div><!-- end col-lg-6 -->
                    <div class="col-lg-6">
                        <ul class="flex-wrap generic-list-item d-flex align-items-center fs-14 justify-content-end">
                            <li class="mr-3"><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        </ul>
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

    <!-- Modal -->
    <div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="text-center modal-body">
                    <span class="la la-exclamation-circle fs-60 text-warning"></span>
                    <h4 class="pt-2 pb-1 modal-title fs-19 font-weight-semi-bold" id="deleteModalTitle">Your account
                        will be deleted permanently!</h4>
                    <p>Are you sure you want to delete your account?</p>
                    <div class="pt-4 btn-box">
                        <button type="button" class="mr-3 btn font-weight-medium"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok, Delete</button>
                    </div>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->


    <!-- template js files -->
    <script src="{{ asset('aduca/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('aduca/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('aduca/js/isotope.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('aduca/js/fancybox.js') }}"></script>
    <script src="{{ asset('aduca/js/animated-skills.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery.MultiFile.min.js') }}"></script>
    <script src="{{ asset('aduca/js/jquery-te-1.4.0.min.js') }}"></script>
    <script src="{{ asset('aduca/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('aduca/js/main.js') }}"></script>
</body>

</html>