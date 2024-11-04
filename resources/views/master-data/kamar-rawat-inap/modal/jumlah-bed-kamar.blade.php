<div class="modal fade" id="modal-bed-kamar" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0">
                <!--begin::Close-->
                <h3 class="modal-title" id="title-bed-kamar"></h3>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y">
                <!--begin:Form-->  
                @include(customForm("master-data", "kamar-rawat-inap", "jumlah-bed-kamar"))
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>