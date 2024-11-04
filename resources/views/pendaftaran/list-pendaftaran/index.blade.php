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
               <!--begin::Card header-->
               <div class="card-header border-0 pt-6">
                  <!--begin::Card title-->
                  <div class="card-title">
                     <!--begin::Search-->
                     <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari Data Pendaftaran" />
                     </div>
                     <!--end::Search-->
                  </div>
                  <!--begin::Card title-->
               </div>
               <!--end::Card header-->
               <!--begin::Card body-->
               <div class="card-body py-4">
                  @include(table())
               </div>
               <!--end::Card body-->
            </div>
            <!--end::Card Tindakan-->
         </div>
         <!--end::Content container-->
      </div>
      <!--end::Content-->
   </div>
   <!--end::Content wrapper-->
</div>
<!--end:::Main-->
@stop