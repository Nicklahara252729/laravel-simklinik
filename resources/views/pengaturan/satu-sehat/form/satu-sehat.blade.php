<form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_create_account_form">
    <div class="current" data-kt-stepper-element="content">
        <div class="w-100">
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold form-label mb-2">Mode</label>
                    <!--end::Label-->
                    <select name="card_expiry_month" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month">
                        <option>Pilih Mode</option>
                        <option value="1">Live</option>
                        <option value="2">Development</option>
                    </select>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Organization-ID</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Masukan Organization ID" id="no_identity" name="no_identity" required />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Secret Key</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Masukan Secret Key" id="name" name="name" required />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Client Key</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Masukan Cient Key" id="no_identity" name="no_identity" required />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Token</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Masukan Token" id="name" name="name" required />
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Notice-->
            <div class="d-flex justify-content-between">
                <!--begin::Label-->
                <div class="fw-semibold">
                    <label class="fs-6">Status</label>
                </div>
                <!--end::Label-->
                <!--begin::Switch-->
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="" checked="checked" />
                    <span class="form-check-label fw-semibold text-muted">Nonaktif</span>
                </label>
                <!--end::Switch-->
            </div>
            <!--end::Notice-->
        </div>

        <div class="d-flex flex-stack pt-15 justify-content-end">
            <!--begin::Wrapper-->
            <div>
                <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="">Tes Koneksi
                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                    <span class="indicator-label">Simpan
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Wrapper-->
        </div>
    </div>
    <!--end::Actions-->
</form>
