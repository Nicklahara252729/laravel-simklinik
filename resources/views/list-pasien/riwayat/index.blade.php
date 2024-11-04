@extends('themes.theme-panel')

@section('content')
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
   <div class="d-flex flex-column flex-column-fluid">
      <div id="kt_app_content" class="app-content flex-column-fluid">
         <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-7">
               <div class="card-header">
                  <div class="card-title">
                     <div class="d-flex align-items-center position-relative my-1">
                        <input type="text" class="form-control form-control-solid w-250px ps-4" name="no_rm" placeholder="Masukan No RM" />
                     </div>
                  </div>
                  <div class="card-toolbar">
                     <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <button class="btn btn-primary" id="generate-surat">Unduh PDF</button>

                     </div>
                  </div>
               </div>
               <div class="card-body">
                  @include(components('list-pasien', 'riwayat', 'plain-paper', 'plain-paper'))
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop