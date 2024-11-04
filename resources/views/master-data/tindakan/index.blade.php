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
                <!--begin::Card Tindakan-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title gap-4">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari Data Tindakan" />
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
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                {{-- <a href="#" type="button" class="btn btn-primary me-2">
                                    <i class="ki-outline ki-arrows-circle fs-2"></i>Sinkronisasi BPJS
                                </a> --}}
                                <a type="button" id="open-create-modal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tindakan">
                                    <i class="ki-outline ki-plus fs-2"></i>Tambah
                                </a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        @include(customTable('master-data', 'tindakan', 'tindakan'))
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card Tindakan-->
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