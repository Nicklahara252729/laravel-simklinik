@extends('themes.theme-panel')

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-9">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="image">
                                        <div
                                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Pic-->

                                <!--begin::Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#"
                                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1" data-key="name">User</a>
                                                <a href="#"><i class="ki-outline ki-verify fs-1 text-primary"></i></a>
                                            </div>
                                            <!--end::Name-->

                                            <!--begin::Info-->
                                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                <a href="#"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i> <span data-key="level"></span>
                                                </a>
                                                <a href="#"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i> <span data-key="nama-faskes"></span>
                                                </a>
                                                <a href="#"
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                                    <i class="ki-outline ki-sms fs-4"></i> <span data-key="email"></span>
                                                </a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Title-->
{{-- 
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap flex-stack">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column flex-grow-1 pe-8">
                                            <!--begin::Stats-->
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                            data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                                            data-kt-initialized="1">$4,500</div>
                                                    </div>
                                                    <!--end::Number-->

                    
                                                    <div class="fw-semibold fs-6 text-gray-500">Earnings</div>
                                                </div>
                                                <!--end::Stat-->

                                                <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                            data-kt-countup-value="80" data-kt-initialized="1">80</div>
                                                    </div>
                                                    <!--end::Number-->

                    
                                                    <div class="fw-semibold fs-6 text-gray-500">Projects</div>
                                                </div>
                                                <!--end::Stat-->

                                                <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                                        <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                                            data-kt-countup-value="60" data-kt-countup-prefix="%"
                                                            data-kt-initialized="1">%60</div>
                                                    </div>
                                                    <!--end::Number-->

                    
                                                    <div class="fw-semibold fs-6 text-gray-500">Success Rate</div>
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Wrapper-->

                                        {{-- <!--begin::Progress-->
                                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                <span class="fw-semibold fs-6 text-gray-500">Profile Compleation</span>
                                                <span class="fw-bold fs-6">50%</span>
                                            </div>
                    
                                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Stats--> --}}
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->

                            {{-- <!--begin::Navs-->
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="/metronic8/demo55/../demo55/account/overview.html">
                                            Overview                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/settings.html">
                                            Settings                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/security.html">
                                            Security                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/activity.html">
                                            Activity                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/billing.html">
                                            Billing                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/statements.html">
                                            Statements                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/referrals.html">
                                            Referrals                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/api-keys.html">
                                            API Keys                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                                <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/metronic8/demo55/../demo55/account/logs.html">
                                            Logs                    </a>
                                    </li>
                                    <!--end::Nav item-->
                                        </ul>
                            <!--begin::Navs--> --}}
                        </div>
                    </div>

                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Detail profil</h3>
                            </div>

                            <a href="javascript:void(0)"
                                class="btn btn-sm btn-primary align-self-center">Edit Profile</a>
                        </div>

                        <div class="card-body p-9">
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Nama Lengkap</label>g

                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800" data-key="name"></span>
                                </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Nama Faskes</label>

                            <div class="col-lg-8 fv-row">
                                <span class="fw-semibold text-gray-800 fs-6" data-key="nama-faskes"></span>
                            </div>
                        </div>


                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Alamat Faskes</label>

                            <div class="col-lg-8">
                                <a href="#"
                                    class="fw-semibold fs-6 text-gray-800 text-hover-primary" data-key="alamat-faskes"></a>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">
                                Kontak Telepon

                                {{-- <span class="ms-1" data-bs-toggle="tooltip" aria-label="Nomor telepon harus aktif"
                                    data-bs-original-title="Nomor telepon harus aktif" data-kt-initialized="1">
                                    <i class="ki-outline ki-information fs-7"></i> --}}
                                </span>
                            </label>

                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bold fs-6 text-gray-800 me-2" data-key="phone"></span>
                                {{-- <span class="badge badge-success">Terverifikasi</span> --}}
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Nomor KTP</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="no-ktp"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Nomor NPWP</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="no-npwp"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Nomor STR</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="no-str"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Tanggal Berlaku STR</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="tgl-berlaku-str"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Tanggal Berakhir STR</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="tgl-berakhir-str"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Nomor SIP</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="no-sip"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Tanggal Berlaku SIP</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="tgl-berlaku-sip"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Tanggal Berakhir SIP</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="tgl-berakhir-sip"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Alamat</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="alamat"></span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Spesialis</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800" data-key="spesialis"></span>
                            </div>
                        </div>

                        <!--begin::Notice-->
                        {{-- <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i> <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 ">
                                <!--begin::Content-->
                                <div class=" fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">We need your attention!</h4>

                                    <div class="fs-6 text-gray-700 ">Your payment was declined. To start using tools,
                                        please <a class="fw-bold"
                                            href="/metronic8/demo55/../demo55/account/billing.html">Add Payment Method</a>.
                                    </div>
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Wrapper-->
                        </div> --}}
                        <!--end::Notice-->
                    </div>
                    <!--end::Card body-->
                </div>
                {{-- @include(modal()) --}}
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
@stop
