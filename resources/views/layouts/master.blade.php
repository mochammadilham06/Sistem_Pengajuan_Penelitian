<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Sistem Pengajuan Dana Hibah dan Insentif Reviewer</title>
    <link rel="apple-touch-icon" href="{{ asset('') }}assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/themes/semi-dark-layout.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/plugins/forms/form-validation.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/css/style.css">
    <!-- END: Custom CSS-->
    @stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">

            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status">{{Auth::user()->role->name}}</span></div><span class="avatar"><img class="round" src="{{ asset('') }}assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <!-- <a class="dropdown-item" href="page-auth-login-v2.html"><i class="mr-50" data-feather="power"></i> Logout</a> -->
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">

                <li class="nav-item me-auto"><a class="navbar-brand" href="{{asset('')}}html/ltr/vertical-menu-template-semi-dark/index.html"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">The Group</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('home')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>


                @if(auth()->user()->role_id == '2')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Pengajuan Dana</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('pengajuan.index') }}"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Hibah & Insentif</span></a>
                        </li>
                    </ul>
                </li>


                @endif

                @if(auth()->user()->role_id == '4')
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('kelola-surat.index') }}"><i data-feather="check-square"></i><span class="menu-title text-truncate" data-i18n="Todo">Kelola Surat Kontrak Hibah Penelitian</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('pengarsipan') }}"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">Pengarsipan Kontrak</span></a>
                </li>
                @endif

                @if(auth()->user()->role_id == '3')
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Validasi</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="{{route('validasi-pengajuan.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Pengajuan Dana Hibah</span></a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(auth()->user()->role_id == '1')
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('users.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Kelola Akun</span></a>
                </li>
                @endif
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->

                @yield('content')
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a class="ml-25" href="#" target="_blank"></a><span class="d-none d-sm-inline-block">Kelompok
                    1 Apsi, All rights Reserved</span></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('') }}assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('') }}assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>

    <script src="{{ asset('') }}assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
    <script src="{{ asset('') }}assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('') }}assets/js/scripts/forms/form-validation.js"></script>


    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('') }}assets/js/core/app-menu.js"></script>
    <script src="{{ asset('') }}assets/js/core/app.js"></script>
    <script src="{{ asset('') }}assets/js/core/app-menu.min.js"></script>
    <script src="{{ asset('') }}assets/js/core/app.min.js"></script>
    <script src="{{ asset('') }}app-assets/js/scripts/customizer.min.js"></script>


    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('') }}assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <script script src="{{ asset('') }}assets/js/scripts/pages/modal-edit-user.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>

    <!-- END: Page JS-->


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
    @stack('scripts')
    @include('sweetalert::alert')

</body>
<!-- END: Body-->

</html>