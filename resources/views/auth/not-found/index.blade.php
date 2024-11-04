<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="page" content="auth" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logout.png') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{asset('assets/css/config/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/config/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <style>
        body {
            background-image: url({{ asset('assets/images/media/auth/bg1.jpg') }});
        }

        [data-bs-theme="dark"] body {
            background-image: url({{ asset('assets/images/media/auth/bg1-dark.jpg') }});
        }
    </style>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <div class="d-flex flex-column flex-center text-center p-10">
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">Kami tidak dapat menemukan halaman tersebut :(.</div>
                        <div class="mb-3">
                            <img src="{{ asset('assets/images/media/auth/404-error.png') }}" class="mw-100 mh-300px theme-light-show"
                                alt="" />
                            <img src="{{ asset('assets/images/media/auth/404-error-dark.png') }}" class="mw-100 mh-300px theme-dark-show"
                                alt="" />
                        </div>
                        <div class="mb-0">
                            <a href="/dashboard" class="btn btn-sm btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/config/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/config/scripts.bundle.js')}}"></script>
</body>

</html>
