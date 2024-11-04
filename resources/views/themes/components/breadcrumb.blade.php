<div id="kt_app_toolbar" class="app-toolbar pt-2 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                    {{ isset($subpage) ? $subpage : $page }}
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">{{ $page }}</li>

                    @if(isset($subpage))
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ $subpage }}</li>
                    @endif

                    <span class="additional-breadcrumb breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 ms-2"></span>
                </ul>
            </div>
            <button class="btn btn-lg btn-light-primary mb-3" id="back-to-start" hidden>
                <i class="ki-outline ki-arrow-left fs-3"></i></span>
                Kembali ke awal
            </button>
        </div>
    </div>
</div>