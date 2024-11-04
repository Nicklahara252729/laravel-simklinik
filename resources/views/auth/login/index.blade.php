@extends('themes.theme-auth')
@section('content')
    <form class="form w-100" id="kt_sign_in_form">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px"
                src="{{ asset('assets/images/logo/metro-simpus.png') }}" alt="" />
            <!--end::Title-->
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Masukkan Username dan Password</div>
        </div>
        <!--begin::Heading-->
        <!--begin::Input group=-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Username" name="username" class="form-control bg-transparent" required />
            <!--end::Email-->
        </div>
        <!--end::Input group=-->

        <!--begin::Main wrapper-->
        <div class="fv-row" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-3">
                {{-- <!--begin::Label-->
                <label class="form-label fw-semibold fs-6 mb-2">
                    Password
                </label>
                <!--end::Label--> --}}

                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-lg bg-transparent" type="password" placeholder="Password"
                        name="password" autocomplete="off" />

                    <!--begin::Visibility toggle-->
                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                        data-kt-password-meter-control="visibility">
                        <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span></i>
                    </span>
                    <!--end::Visibility toggle-->
                </div>
                <!--end::Input wrapper-->
            </div>
        </div>
        <!--end::Input group=-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <!--begin::Link-->
            <a href="#" class="link-primary">Forgot Password ?</a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Sign In</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->
    </form>
@stop
