@extends('themes.theme-panel')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper">
                    <div class="stepper-nav mb-5 form-stepper" id="stepper-nav">
                        <div class="row">
                            <div class="d-flex overflow-auto">
                                <div class="stepper-item current" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Jenis Layanan</h3>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Jenis Pasien</h3>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Jenis Pelayanan</h3>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Data Pribadi</h3>
                                </div>
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Data Penanggung Jawab dan Pendukung</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include(form())
                </div>
            </div>
        </div>
    </div>
</div>
@stop