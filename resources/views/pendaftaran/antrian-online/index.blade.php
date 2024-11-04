@extends('themes.theme-panel')
@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper">
                    <div class="stepper-nav mb-5 form-stepper">
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Langkah 1</h3>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Langkah 2</h3>
                        </div>
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Langkah 3</h3>
                        </div>
                    </div>
                    @include(form())
                </div>
            </div>
        </div>
    </div>
</div>
@stop