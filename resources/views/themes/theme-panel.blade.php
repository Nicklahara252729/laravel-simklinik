<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="page" content="panel" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo/logo.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link rel="stylesheet" type="text/css" href="{{asset(css()['plugin'].'.css')}}">

    <link href="{{asset('assets/css/config/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/config/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/config/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/config/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(css()['css'].'.css')}}">

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/datatables.bundle.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-animation="false" data-kt-sticky-offset="{default: '0px', lg: '0px'}">
                <!--begin::Header container-->
                <div class="app-container container-fluid d-flex align-items-stretch flex-stack border-bottom" id="kt_app_header_container">
                    @include('themes.components.header.toogle')
                    @include('themes.components.header.navbar')
                </div>
            </div>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div id="kt_app_sidebar" class="app-sidebar flex-column border-end ps-2 pe-2 ps-lg-7 pe-lg-4" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                    @include('themes.components.sidebar.header')
                    @include('themes.components.sidebar.menu')
                    @include('themes.components.sidebar.footer')
                </div>
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <div class="d-flex flex-column flex-column-fluid">
                            @include('themes.components.breadcrumb')
                            @yield('content')
                        </div>
                    </div>
                    @include('themes.components.footer')
                </div>
            </div>
        </div>
    </div>

    @include('themes.components.modal.ubah-password')

    <script src="{{ asset('assets/js/config/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/config/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables/datatables.bundle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>


    <script src="{{ asset('assets/js/config/config.js') }}"></script>
    <script src="{{ asset('assets/js/config/custom.js') }}"></script>
    <script src="{{ asset('assets/js/utilities/request.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/token.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/sweetalert.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/UserData.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/authorize.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/signout.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/role.js')}}"></script>
    <script src="{{ asset('assets/js/helpers/IdleTracker.js')}}" type="module"></script>

    <script src="{{ asset(js()['plugin'].'.js') }} "></script>
    <script src="{{ asset(js()['js'].'.js') }} " type="module"></script>

</body>

</html>