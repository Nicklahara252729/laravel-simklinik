<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="page" content="auth" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo/logo.png')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link href="{{asset('assets/css/config/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/config/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/config/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/config/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(cssAuth()['plugin'].'.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset(cssAuth()['css'].'.css')}}">

</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <!--begin::Image-->
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" style="transform : scale(1.25)" src="{{asset('assets/images/media/Medicine-bro.svg')}}" alt="" />

                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Sistem Informasi Manajemen Puskesmas</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    {{-- <div class="text-gray-600 fs-base text-center fw-semibold d-none d-sm-block                    ">
                        Sistem yang dirancang dengan beragam fitur multi-pengguna yang mengoptimalkan proses layanan, membantu dalam manajemen yang efisien bagi fasilitas Puskesmas. 
                        <br>Platform terpadu ini memfasilitasi operasional yang lancar, membantu manajemen yang komprehensif terhadap layanan kesehatan di fasilitas Puskesmas. 
                        <br>Rasakan sistem yang terhubung untuk meningkatkan efisiensi operasional, mempromosikan kolaborasi, dan menjamin integritas proses manajemen.
                    </div> --}}
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!--begin::Wrapper-->
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!--begin::Form-->
                            @yield('content')
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
        </div>
        <footer class="bg-white d-flex justify-content-center align-items-center p-5">
            <div class="text-gray-900 order-2 order-md-1">
                <span class="text-muted fw-semibold me-1 fs-5">2023©</span>
                <a href="#" target="_blank" class="fs-5 text-gray-800 text-hover-primary">Laravel Simklinik</a>
            </div>
        </footer>
        <!--end::Authentication - Sign-in-->
    </div>

    <script src="{{asset('assets/js/config/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/config/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/vendors/sweetalert2/sweetalert2.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>

    <script src="{{asset('assets/js/config/config.js')}}"></script>
    <script src="{{asset('assets/js/config/custom.js')}}"></script>
    <script src="{{asset('assets/js/utilities/request.js')}}"></script>
    <script src="{{asset('assets/js/utilities/token.js')}}"></script>
    <script src="{{asset('assets/js/utilities/sweetalert.js')}}"></script>
    <script src="{{ asset('assets/js/utilities/authorize.js')}}"></script>


    <script src="{{asset(jsAuth()['plugin'].'.js')}} "></script>
    <script src="{{asset(jsAuth()['js'].'.js')}} " type="module"></script>
</body>

</html>