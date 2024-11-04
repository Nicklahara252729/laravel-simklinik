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
                <!--begin::Card Laborat-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        @include(customTable('master-data', 'jadwal-poli', 'jadwal-poli'))
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card Laborat-->

                <!--Modal-->
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