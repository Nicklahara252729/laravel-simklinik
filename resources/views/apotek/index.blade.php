@extends('themes.theme-panel')

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Card Master obat-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                            <!--begin::Card title-->
                            <div class="card-title gap-4">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                    <input type="text" data-kt-user-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-13" placeholder="Cari data..." />
                                </div>

                                <div class="input-group input-group-solid flex-nowrap">
                                    <span class="input-group-text">
                                        <i class="ki-outline ki-abstract-46 fs-3"></i>
                                    </span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select id="poliklinik-select" class="form-select form-select-solid fw-bold rounded-start-0 border-start min-w-200px"
                                                data-control="select2" data-placeholder="Pilih poliklinik ...">
                                                <option></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="input-group input-group-solid flex-nowrap" id="date-filter">
                                    <span class="input-group-text">
                                        <i class="ki-outline ki-calendar fs-3"></i>
                                    </span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <input class="form-control form-control-solid fw-bold rounded-start-0 border-start min-w-200px" id="date-range-picker" placeholder="Pilih tanggal">
                                    </div>
                                </div>

                                <div class="input-group input-group-solid flex-nowrap" id="status-filter">
                                    <span class="input-group-text">
                                        <i class="ki-outline ki-setting-2 fs-3"></i>
                                    </span>
                                    <div class="overflow-hidden flex-grow-1">
                                        <select id="status-select" class="form-select form-select-solid fw-bold rounded-start-0 border-start min-w-200px"
                                                data-control="select2" data-placeholder="Pilih status ...">
                                                <option value="pending">Sedang Antri</option>
                                                <option value="done">Telah Dilayani</option>
                                                <option value="all">Semua</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base"
                                    data-select2-id="">
                                    <!--begin::Filter-->
                                    
                                    <!--end::Menu 1--> <!--end::Filter-->
                                    <!--end::Add user-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            @include(table())
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card Master obat-->
                    @include(modal())
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
@stop
